<?php
// Require Composer dependencies
$autoload_file = 'vendor/autoload.php';
if ( file_exists( $autoload_file ) ) {
	require_once $autoload_file;
}

use Spatie\CalendarLinks\Link;

$files_to_require = array(
    'class-rh-svg.php',
);
foreach ( $files_to_require as $filename ) {
	$file = 'functions/' . $filename;
	if ( file_exists( $file ) ) {
		require_once $file;
	}
}

// Add to calendar links
$time_zone = new DateTimeZone( 'America/New_York' );
$from = DateTime::createFromFormat( 'Y-m-d H:i', '2023-10-07 19:00', $time_zone );
$to   = DateTime::createFromFormat( 'Y-m-d H:i', '2023-10-08 00:00', $time_zone );

$event_link = Link::create('Hamond High School\'s 20th Reunion', $from, $to)
    ->description('')
    ->address('Kelsey\'s Irish Pub, 8480 Baltimore National Pike, Ellicott City, MD 21043');

$calendar_links = array(
    'google' => (object) array(
        'url'         =>  $event_link->google(),
        'icon_slug'   => 'google-g',
        'label'       => 'Google',
        'helper_text' => 'Add the event to your Google calendar',
    ),
    'apple' => (object) array(
        'url'       =>  $event_link->ics(),
        'icon_slug' => 'apple',
        'label'     => 'Apple',
        'helper_text' => 'Add the event to your Apple iCal calendar',
    ),
    'outlook' => (object) array(
        'url'       =>  $event_link->ics(),
        'icon_slug' => 'outlook',
        'label'     => 'Outlook',
        'helper_text' => 'Add the event to your Outlook calendar',
    ),
);
?>
<!doctype html>
<html class="no-js" lang="en-US">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Inter:wght@500;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/hammond-high-20th-reunion.min.css" type="text/css" media="all" />
	</head>
	<body class="h-event">
        <header>
            <p class="class-of">'03</p>
            <h1 class="p-name site-title">Hammond High School <span>20<sup>th</sup> Reunion</span></h1>
        </header>

        <main>
            <section class="blocks">

                <div class="block">
                    <div class="block-label">
                        <h2>When</h2>
                    </div>
                    <div class="block-content">
                        <div class="when-content">
                            <p><time datetime="2023-10-07T19:00:00+0000" class="dt-start">October 7th, 2023 at 7:00pm</time></p>

                            <p class="list-label">Add to Calendar</p>
                            <ul class="add-to-calendar icon-list">
                                <?php foreach( $calendar_links as $item ) : ?>
                                    <li>
                                        <a href="<?php echo $item->url; ?>" title="<?php echo $item->helper_text ?>" target="_blank">
                                           <?php echo RH_SVG::get_icon( $item->icon_slug ); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="block block--right">
                    <div class="block-label">
                        <h2>Where</h2>
                    </div>
                    <div class="block-content">
                        <div class="the-location p-location h-card">
                            <p class="p-name"><a href="https://www.kelseysrestaurant.com/">Kelsey's Irish Pub</a></p>
                            <p class="p-street-address">8480 Baltimore National Pike</p>
                            <p>
                                <span class="p-locality">Ellicott City</span>, <abbr title="Maryland" class="p-region">MD</abbr> <span class="p-postal-code">21043</span>
                            </p>

                            <p class="list-label">Get Directions</p>
                            <ul class="get-directions icon-list">
                                <li>
                                    <a href="https://goo.gl/maps/Uo4Yo392RJpAzKQa6" title="Get directions via Google Maps"><?php echo RH_SVG::get_icon( 'google-maps' ); ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="block">
                    <div class="block-label">
                        <h2>Buy Tickets</h2>
                    </div>
                    <div class="block-content">
                        <div class="ticket-content">
                           <p><strong>$25 per ticket</strong></p>
                            <p>Includes appetizers and non-alcoholic beverages</p>
                            <p>Pay Russell Heimlich</p>
                            <ul class="payment-options">
                                <li><a href="https://www.paypal.com/paypalme/kingkool68"><?php echo RH_SVG::get_icon( 'paypal' ); ?></a></li>
                                <li><a href="https://venmo.com/u/kingkool68"><?php echo RH_SVG::get_icon( 'venmo' ); ?></a></li>
                                <li><a href="https://cash.app/$kingkool68"><?php echo RH_SVG::get_icon( 'cash-app' ); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <img src="assets/img/grizzly-bear-wearing-cool-sunglasses.png" class="cool-grizzly">

        <footer><p>&copy;<?php echo date('Y'); ?><p></footer>

        <script src="https://cdn.jsdelivr.net/npm/add-to-calendar-button@2" async defer></script>
	</body>
</html>
