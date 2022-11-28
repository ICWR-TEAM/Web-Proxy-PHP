<?php

require_once("web_proxy.php");

use webProxy as WP;

$classAPI = New WP\PROXY();

echo $classAPI->forwarder();
