<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cuaca extends CI_Controller
{
    private $base = 'frontend';
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $arr_day = [];
        $str_day = '';
        foreach ($this->xmlToArray() as $row) {
            if (substr($row['datetime'], 0, 8) != $str_day) {
                $y = substr($row['datetime'], 0, 4);
                $m = substr($row['datetime'], 4, 2);
                $d = substr($row['datetime'], 6, 2);
                $arr_day[] = $y . '-' . $m . '-' . $d;
            }
            $str_day = substr($row['datetime'], 0, 8);
        }
        //echo json_encode($arr_day);exit();
        $data = [
            'li_cuaca' => 'active',
            'prakiraan' => ['days' => $arr_day, 'cuaca' => $this->xmlToArray()],
            //'extra_js' => "$this->base/cuaca/index_js",
        ];
        $this->template->content_frontend("$this->base/cuaca/index", $data);
    }

    function xmlToArray()
    {
        $sXML = $this->download_page('https://data.bmkg.go.id/datamkg/MEWS/DigitalForecast/DigitalForecast-JawaTengah.xml');
        $oXML = new SimpleXMLElement($sXML);
        $area = $oXML->forecast->area;
        $compile = [];

        for ($x = 0; $x < count($area); $x++) {
            if ($area[$x][0]['id'] == '501266') {
                for ($y = 0; $y < count($area[$x]->parameter[5]->timerange); $y++) {
                    $row = [];
                    $row['datetime']        = $area[$x]->parameter[5]->timerange[$y][0]['datetime'];
                    $row['temp_c']          = $area[$x]->parameter[5]->timerange[$y]->value[0];
                    $row['temp_f']          = $area[$x]->parameter[5]->timerange[$y]->value[1];
                    $row['humidity']        = $area[$x]->parameter[0]->timerange[$y]->value;
                    $row['wind_speed']      = $area[$x]->parameter[8]->timerange[$y]->value[2];
                    $row['wind_direction']  = $area[$x]->parameter[7]->timerange[$y]->value[1];
                    $row['weather']         = $area[$x]->parameter[6]->timerange[$y]->value;
                    $compile[]              = $row;
                }
            }
        }
        //echo json_encode($compile); //un-comment this line to show return array
        return $compile;
    }

    function download_page($path)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $retValue = curl_exec($ch);
        curl_close($ch);
        return $retValue;
    }

    public function cuaca_mobile()
    {
        $arr_day = [];
        $str_day = '';
        foreach ($this->xmlToArray() as $row) {
            if (substr($row['datetime'], 0, 8) != $str_day) {
                $y = substr($row['datetime'], 0, 4);
                $m = substr($row['datetime'], 4, 2);
                $d = substr($row['datetime'], 6, 2);
                $arr_day[] = $y . '-' . $m . '-' . $d;
            }
            $str_day = substr($row['datetime'], 0, 8);
        }
        $data = [
            'li_cuaca' => 'active',
            'prakiraan' => ['days' => $arr_day, 'cuaca' => $this->xmlToArray()],
            //'extra_js' => "$this->base/cuaca/index_js",
        ];
        $this->template->content_mobile_frontend("$this->base/cuaca/index_mobile", $data);
    }
}
/* End of file Front.php */
