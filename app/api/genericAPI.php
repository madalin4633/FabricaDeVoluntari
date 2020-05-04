class GenericAPI {
    public function middlewares($array) {
        for ($i = 0; $i < sizeof($array); $i++) {
            if (! $this -> $array[$i][0]($array[$i][1])) {
                break;
            }
        }
    }
    public function adminOnly() {
        //TODO check if user is admin

        http_response_code(400);
        return true;
    }

    public function volunteerOnly() {
        return true;
    }

}