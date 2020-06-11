<?php
class GenericAPI {
    protected function isDatabaseAdmin($params) {
        //TODO check if user is DB admin

        // http_response_code(400);
        return true;
    }

    protected function volunteerOnly() {}

    protected function middlewares($array) {
        for ($i = 0; $i < sizeof($array)-1; $i++) {
            $middleware = $array[$i][0];
            if (! $this->$middleware($array[$i][1])) {
                break;
            }
        }

        $i < sizeof($array)-1;
        $callfunc = $array[$i][0];
        $callfunc($array[$i][1][0]);
    }
}