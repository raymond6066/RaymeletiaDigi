<?php

class CynicOnePageMap {

    public function __construct() {
        add_shortcode('cynic_onepage_map', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_onepage_map',
                'name' => __('One Page Map', 'cynic'),
                "category" => __("Cynic Onepage", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'lat',
                        'type' => 'textfield',
                        'heading' => __('Map Lat', 'cynic'),
                        'value' => '-37.8274851',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'lng',
                        'type' => 'textfield',
                        'heading' => __('Map Lng', 'cynic'),
                        'value' => '144.9527565',
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'lat' => '-37.8274851',
            'lng' => '144.9527565',
                ), $atts);
        extract($atts);
        ob_start();
        ?>
        <div id="map"></div> 
        <script type='text/javascript'>
            //Custom Google Maps
            function initMap() {
                // Styles a map in night mode.
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: <?php echo $lat ?>, lng: <?php echo $lng ?>},
                    zoom: 13,
                    scrollwheel: false,
                    styles: [{
                            "elementType": "geometry",
                            "stylers": [{
                                    "color": "#f5f5f5"
                                }]
                        },
                        {
                            "elementType": "labels.icon",
                            "stylers": [{
                                    "visibility": "off"
                                }]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                    "color": "#616161"
                                }]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [{
                                    "color": "#f5f5f5"
                                }]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                    "color": "#bdbdbd"
                                }]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [{
                                    "color": "#eeeeee"
                                }]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                    "color": "#757575"
                                }]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [{
                                    "color": "#e5e5e5"
                                }]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                    "color": "#9e9e9e"
                                }]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [{
                                    "color": "#ffffff"
                                }]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                    "color": "#757575"
                                }]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [{
                                    "color": "#dadada"
                                }]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                    "color": "#616161"
                                }]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                    "color": "#9e9e9e"
                                }]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "geometry",
                            "stylers": [{
                                    "color": "#e5e5e5"
                                }]
                        },
                        {
                            "featureType": "transit.station",
                            "elementType": "geometry",
                            "stylers": [{
                                    "color": "#eeeeee"
                                }]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [{
                                    "color": "#c9c9c9"
                                }]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                    "color": "#9e9e9e"
                                }]
                        }
                    ]
                });

                var marker = new google.maps.Marker({
                    position: {lat: <?php echo $lat ?>, lng: <?php echo $lng ?>},
                    map: map,
                    icon: "<?php echo get_template_directory_uri() ?>/images/marker.png"
                });
                google.maps.event.addListener(window, 'resize', function () {
                    var center = map.getCenter();
                    google.maps.event.trigger(map, "resize");
                    map.setCenter(center);
                })
            }
        </script>
        <?php
        return ob_get_clean();
    }

}
