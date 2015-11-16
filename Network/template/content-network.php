<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Boilerstrap
 * @since Boilerstrap 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		
		<div class="entry-content">
			<?php the_content(); ?>
			<br/> <br/>
			
			<?php
			$args = array(
					'post_type' => 'networks',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'order' => 'ASC'
				);
				$the_query = new WP_Query( $args );
 
				// The Loop
				$index = 0;
				$areas = array();
				$legend = array();
				if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$details = "<strong style='font-size:14px'>".get_the_title()."</strong>
									<div style='margin-bottom:10px'>". get_field('address')."</div>
									<div>".get_the_content()."</div>
									";
						$areas[] = array(
							'id' => get_field('select_location'),
							'title' => $details,
							'showAsSelected' => true,
							'color' => get_field('map_color'),
							'selectedColor' => get_field('map_color'),
							'groupId' => str_replace("PH-", "", get_field('select_location'))
						);
						
						$legend[] = array(
							'title' => get_the_title(),
							'color' => get_field('map_color'),
							'groupId' => str_replace("PH-", "", get_field('select_location'))
						);
					endwhile;
				endif;
				
			?>
			<style type="text/css">
				#chartdiv {
					width	: 100%;
					height	: 800px;
				}	
			</style>
			<div><strong>LEGENDS</strong></div>
			<div id="chartdiv"></div>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'boilerstrap' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
<script src="<?php echo get_template_directory_uri(); ?>/js/ammap.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/philippinesLow.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/none.js"></script>
	<script>
	var map;
	AmCharts.ready( function() {
		map = new AmCharts.AmMap();
		map.panEventsEnabled = false;
		map.backgroundColor = "#fff";
		map.backgroundAlpha = 1;

		map.zoomControl.panControlEnabled = false;
		map.zoomControl.zoomControlEnabled = false;

		var dataProvider = {
			map: "philippinesLow",
			getAreasFromMap : true,
			areas : <?php echo json_encode($areas); ?>
		};
		
		map.dataProvider = dataProvider;
		
		map.areasSettings = {
			autoZoom: false,
			color: "#CDCDCD",
			colorSolid: "#5EB7DE",
			selectedColor: "#5EB7DE",
			outlineColor: "#666666",
			rollOverColor: "#88CAE7",
			rollOverOutlineColor: "#FFFFFF",
			selectable: false,
			dragMap: false,
			mouseEnabled: false
		};
		map.balloon = {
			textAlign: "left",
			cornerRadius: 6,
			adjustBorderColor: false,
			horizontalPadding: 10,
			verticalPadding: 10
		};
		
		map.legend = {
		width: 240,
		marginRight:27,
        marginLeft:27,
        equalWidths:true,
        maxColumns: 1,
		backgroundAlpha: 0.5,
		backgroundColor: "#FFFFFF",
		borderColor: "#ffffff",
		borderAlpha: 1,
		left: 0,
		horizontalGap: 10,
        switchable: true,
		data: <?php echo json_encode($legend); ?>
		};
		
		map.addListener( 'clickMapObject', function( event ) {
			// deselect the area by assigning all of the dataProvider as selected object
			map.selectedObject = map.dataProvider;
			
			// toggle showAsSelected
			event.mapObject.showAsSelected = !event.mapObject.showAsSelected;

			// bring it to an appropriate color
			map.returnInitialColor( event.mapObject );
			
			// let's build a list of currently selected states
			var states = [];
			for ( var i in map.dataProvider.areas ) {
				var area = map.dataProvider.areas[ i ];
				if ( area.showAsSelected ) {
					states.push( area.title );
				}
			}
		} );
		
		//
		map.selectedObjects = [];

		map.addListener('init', function () {
			map.legend.switchable = true;
			map.legend.addListener('clickMarker', AmCharts.myHandleLegendClick);
			map.legend.addListener('clickLabel', AmCharts.myHandleLegendClick);
			function toggleMapObjectAlpha(e) {
				var ALPHA_SELECTED = 0.3;
				var ALPHA_HOVER = 0.5;
				
				// Disable memory otherwise it won't restore initial color
				map.selectedObject = false;
				
				// Walkthrough areas
				for ( i in map.dataProvider.areas ) {
					var area = map.dataProvider.areas[i];
					var path = area.displayObject.node;
					var alpha = 1;
					// CURRENT GROUP
					if ( e.mapObject.groupId == area.groupId ) {
						// CURRENT
						if ( e.mapObject.id == area.id ) {
							// CLICK
							if ( e.type == "clickMapObject" ) {
								path.setAttribute("fill-opacity",ALPHA_SELECTED);
								map.selectedObjects.push(area);
								
							// HOVER
							} else if ( e.type == "rollOverMapObject" ) {
								path.setAttribute("fill-opacity",ALPHA_HOVER);
							}
						}
					}
				}
				
				// CLEAR SELECTION IF GROUP CHANGES
				if ( map.selectedObjects.length && e.mapObject.groupId != map.selectedObjects[0].groupId ) {
					map.selectedObjects = [];        
				}
				
				// REACTIVATE PREVIOUS SELECTED ONES
				for ( i in map.selectedObjects ) {
					var area = map.selectedObjects[i];
					var path = area.displayObject.node;
					path.setAttribute("fill-opacity",ALPHA_SELECTED);
				}
			}
			map.addListener('rollOverMapObject',toggleMapObjectAlpha);
			map.addListener('rollOutMapObject',toggleMapObjectAlpha);
			map.addListener('clickMapObject',toggleMapObjectAlpha);
		});
		
		function handleCursorChange(event) {
			var index = event.index;
			var dataItem = event.chart.dataProvider[index];


			if (previouslyHovered) {
				map.rollOutMapObject(previouslyHovered);
			}

			if (dataItem) {
				var continent = dataItem.continent;
				var areas = continentsDataProvider.areas;

				for (var i = 0; i < areas.length; i++) {
					var area = areas[i];
					if (area.title == continent) {
						map.rollOverMapObject(area);
						previouslyHovered = area;
					}
				}
			}
		}
		var previouslyClicked;
		
		AmCharts.myHandleLegendClick = function (event) {
			var groupId = event.dataItem.groupId;
			var areas = dataProvider.areas;
			
			for (var i = 0; i < areas.length; i++) {
				var area = areas[i];
				var phID = "PH-"+ groupId;
				if (area.id == phID) {
					if (previouslyClicked == phID) {
						map.rollOutMapObject(previouslyClicked);
						previouslyClicked = '';
					}else{
						map.rollOverMapObject(area);
						previouslyClicked = area.id;
					}
					
				}
			}
			map.legend.validateNow();
		}

	
		map.export = {
			enabled: false
		}

		map.write( "chartdiv" );
	} );
	</script>