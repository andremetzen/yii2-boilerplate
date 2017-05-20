<?php

namespace app\services;

use conceptho\ServiceLayer\Response;
use conceptho\ServiceLayer\Service;

class Test extends Service {
	public function actionDoSomthing() {
		return new Response(true, ["message" => "ok!"]);
	}
}