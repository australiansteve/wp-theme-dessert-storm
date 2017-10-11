<?php
/**
 * Kickoff theme setup and build
 */

namespace Dessertstorm;

define( 'DESSERTSTORM_VERSION', '2.0.5' );
define( 'DESSERTSTORM_DIR', __DIR__ );
define( 'DESSERTSTORM_URL', get_template_directory_uri() );

require_once __DIR__ . '/src/custom-login.php';
require_once __DIR__ . '/src/customizer.php';
require_once __DIR__ . '/src/enqueue.php';
require_once __DIR__ . '/src/extras.php';
require_once __DIR__ . '/src/jetpack.php';
require_once __DIR__ . '/src/setup.php';
require_once __DIR__ . '/src/sidebars.php';
require_once __DIR__ . '/src/template-tags.php';
require_once __DIR__ . '/src/woocommerce.php';
require_once __DIR__ . '/shortcodes.php';
