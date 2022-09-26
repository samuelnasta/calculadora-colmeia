<?php
/**	
 * Display correct page based in query string
 */

if(isset($_GET['clients'])) { include_once 'clients.php'; }
if(isset($_GET['orders'])) { include_once 'orders.php'; }
if(isset($_GET['services'])) { include_once 'services.php'; }
if(isset($_GET['settings'])) { include_once 'settings.php'; }