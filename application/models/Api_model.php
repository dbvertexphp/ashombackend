<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
          $this->datareqset = '{
    "ExtractionRequest": {
        "@odata.type": "#DataScope.Select.Api.Extractions.ExtractionRequests.ElektronTimeseriesExtractionRequest",
        "ContentFieldNames": [
            "High",
            "RIC",
            "Universal Close Price",
            "Low",
            "Trade Date",
            "Volume",
            "Open",
            "Last"
        ],
        "IdentifierList": {
            "@odata.type": "#DataScope.Select.Api.Extractions.ExtractionRequests.InstrumentIdentifierList",
            "InstrumentIdentifiers": [
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1060.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1080.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1120.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1140.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1150.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1180.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1182.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1201.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1202.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1210.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1211.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1212.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1213.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1214.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1301.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1302.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1303.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1304.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1320.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1810.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1820.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1830.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1831.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1832.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2001.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2002.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2060.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2070.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2080.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2081.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2090.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2100.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2110.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2120.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2130.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2140.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2150.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2160.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2170.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2180.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2190.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2200.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2210.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2220.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2222.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2230.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2240.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2250.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2270.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2280.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2290.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2300.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2310.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2320.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2330.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2340.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2350.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2360.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2370.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2380.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3001.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3003.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3004.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3005.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3007.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3008.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3060.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3080.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3090.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3091.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4001.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4002.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4003.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4005.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4006.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4007.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4008.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4009.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4011.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4012.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4013.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4031.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4051.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4061.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4070.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4080.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4090.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4100.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4110.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4130.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4140.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4141.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4150.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4161.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4170.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4180.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4190.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4191.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4200.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4210.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4220.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4230.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4240.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4250.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4260.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4261.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4270.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4280.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4290.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4291.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4292.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4300.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4310.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4320.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4321.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4330.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4331.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4332.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4333.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4334.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4335.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4336.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4337.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4338.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4339.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4340.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4342.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4344.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4345.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4346.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4347.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4348.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4700.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "5110.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6001.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6002.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6004.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6012.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6060.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6070.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6090.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7200.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7201.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8012.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8060.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8070.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8080.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8100.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8110.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8120.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8130.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8150.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8160.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8170.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8180.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8190.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8200.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8210.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8230.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8240.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8250.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8260.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8270.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8280.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8300.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8310.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8311.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8312.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9400.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9401.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9402.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9403.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9404.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9405.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9501.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9510.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9511.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9512.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9513.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9514.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9515.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9516.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9517.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9518.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9519.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9520.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AAN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AGLT.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AIRA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AJBNK.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALFH.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALL.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALRAMZ.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMAN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMANT.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMCREIT.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMLK.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARMX.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARTC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ASCI.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ASNC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BHMCAPITAL.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CBD.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CHAE.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CHAESHIN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DAMAC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DEYR.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DFM.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DINC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DINV.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DISB.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DNIN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DRC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DSI.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DTKF.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DU.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DXBE.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EIB.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EIBAN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EKTT.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EMAA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EMAARDEV.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EMAR.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ENBD.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ERC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GFH.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GGIC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GNAV.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GULFA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IFIN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ITHMR.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MADI.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MARKA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MASB.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MAZA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NAHO.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NCC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NGIN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NIH.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NIND.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OIC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ORIENT.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OUTFL.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SAGH.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SALAM.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SALAMA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHUA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SSUD.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TABR.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TKFE.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UFC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UNIK.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UPRO.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABNIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADAVIATION.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADCB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADIB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADNH.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADNIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADNOCDIST.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADSB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AFNIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AGTHIA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AKIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALAIN.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALDAR.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALPHADHABI.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ANAN.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARKAN.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ASM.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AWNIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BILDCO.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BOS.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CBI.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CHAEIN.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CHAESH.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DANA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DHAFRA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DRIVE.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EASYLEASE.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ESG.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ESHRAQ.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ETISALAT.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FAB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FBI.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FCI.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FH.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FIDELITYUNITED.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FNF.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FOODCO.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GCEM.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GCIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GMPC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IH.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IHC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "INVESTB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "JULPHAR.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KICO.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MANAZEL.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "METHAQ.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NBF.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NBQ.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NCTH.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NMDC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OEIHC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ORDS.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PALMS.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKBANK.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKCC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKCEC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKNIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKPROP.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKWCT.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAPCO.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "REEM.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RPM.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SAWAEED.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SCIDC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SG.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SIB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SICO.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SUDATEL.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TAQA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TKFL.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TNI.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UAB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UNION.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WAHA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WATANIA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "YAHSAT.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ZS.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "VOES.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "VISN.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UFCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UECP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UBAR.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TFCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TAOI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SUWP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SSPW.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SPSI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SPFI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SOMS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SOMP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SMNP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SIHC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHRQ.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHPS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHCS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SFMI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SAHS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RNSS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RCCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PHPC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PCLI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OUIC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OTEL.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OSCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ORDS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ORCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OQIC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OPCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OOMS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OOMP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ONES.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OMVS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OMRF.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OMCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OIMS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OIFC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OFMI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OFCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OETI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OEIO.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OEFI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OCOI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OCHL.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OCCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OCAI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OAB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NRED.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NMWI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NLIF.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NHIS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NGCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NFCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NDTI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NBOB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NBII.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NAPI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MTMI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MSPW.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MJI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MHAS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MGMC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MGCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MFCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MCTI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MCDE.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KPCS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HMCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HECI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HBMO.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GSCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GMPI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GICI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GHOS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GFIC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GECS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GECP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FSCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FINC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DTCS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DPCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DMGI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DIDI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DICS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DGEN.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DFII.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DCFI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DBIH.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DBCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CSII.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CMII.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKSB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKNZ.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKMB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKDB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BATP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BAHS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BACS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ATMI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "APBS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AOFS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMII.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMAT.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMAN.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AKPI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AJSS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AJSP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AINS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AFIC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AFAI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABOB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABMI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABHS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AAIC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AACT.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AABQ.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AHCS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BLDN.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BLDNf.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BRES.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "COMB.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DBIS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DICO.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DOBK.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ERES.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FALH.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FALHf.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GISS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GWCS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IGRD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IHGS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IQCD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KCBK.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KINS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MARK.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MCCS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MCGS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MERS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MKDM.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MKDMf.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MPHC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MRDS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NLCS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ORDS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QAMC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QANC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QATR.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QCFD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QETF.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QEWC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QFBQ.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QFLS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QGIR.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QGMS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QGTS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIGD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIIB.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIIC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIMC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QINS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QISB.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QLMI.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QNBK.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QNNC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QOIS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SALM.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UDCD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "VFQS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WDAM.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ZHCD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AAN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AAYA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABAR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ACIC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AGHC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AGLT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AINS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AJWN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALAF.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALAQ.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALEID.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALIMK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALMAN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALMK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALQK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMAR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMARF.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AQAR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARAB.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AREC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARGK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARZA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ASCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ASIYA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ATCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AUBK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AYRE.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AZNOULA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BAITAKREIT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BAREEQ.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BAYK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKIK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKME.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BOUK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BOURSA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BPCC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BURG.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CABL.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CATT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CBKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CGCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CLEA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "COAS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DALQ.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DEER.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EDUK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EKHK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EKTT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ENER.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ENMA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EQUI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FACI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FCEM.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FIRST.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FTIK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GBKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GFCI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GFHK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GIHK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GINS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GNAH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GPIK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HAYK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HCCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HUMN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IFAH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IFIN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "INJA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "INOV.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "INTG.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "INVK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IPGK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "JAZK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "JIYAD.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KAMC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KBTK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KCEM.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KCIN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KCPC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KFDC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KFH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KFSK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KGLK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KHOT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KIBK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KIDK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KINS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KINV.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KMEF.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KPPC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KPRO.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KREK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KSHC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KWRE.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "LAND.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "LOGK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MABK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MADI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MADR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MALK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MANK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MARA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MARKZ.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MASH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MASKN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MAZA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MBRD.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MENK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MEZZ.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MIDAN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MRCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MREC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MUNK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MUNS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NAPS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NBKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NCCI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NIBM.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NIHK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NIND.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NINV.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NOOR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NREK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OLAK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OORE.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OSOS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OSUL.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OULA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PAPE.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PAPK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PCEM.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "REAM.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "REMAL.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RKWC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SAGH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SALB.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SANK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SCFK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SECH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SENE.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHIP.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHOT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SOOR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SPEC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SREK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "STC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TAHS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TAMI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TAMK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "THURY.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TIJA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TIJK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UNIC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UPAC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UREK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WARB.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WARBA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WETH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WINS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "YIAC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ZAIN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4004.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABCB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALBH.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "APMTB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARIG.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AUBB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BANA.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BARKA.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BBKB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BCFC.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BFMC.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BISB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKIC.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BMEB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BMMI.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BMUS.BH"
                }
            ],
            "UseUserPreferencesForValidationOptions": "true"
        },
        "Condition": {
            "ReportDateRangeType": "Range",
            "QueryStartDate": "encodedstart",
            "QueryEndDate": "encodedend",
            "LastEntityOnly": "false"
        }
    }
}';
    }

    public function getrefinitivedata($auth_key=""){
  $startdate = date("Y-m-d");
  $enddate = date("Y-m-d");
  $post_data = str_replace("encodedend", "$enddate", str_replace("encodedstart", "$startdate", $this->datareqset));

  $main_url = 'https://selectapi.datascope.refinitiv.com/RestApi/v1/Extractions/ExtractWithNotes';
  $http_sign = false;
   echo "Yes1";
  $crl = curl_init($main_url);
  curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($crl, CURLINFO_HEADER_OUT, true);
  curl_setopt($crl, CURLOPT_POST, true);
  curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);

  // Set HTTP Header for POST request
  curl_setopt($crl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata',
       'Prefer:respond-async',
        'Content-Type:application/json',
        'Authorization:Token '.$auth_key
  ));

  // Submit the POST request
  $result = curl_exec($crl);

  // handle curl error
;
  if ($result === false) {
      throw new Exception('Curl error: ' . curl_error($crl));
      print_r('Curl error: ' . curl_error($crl));
      $result_noti = 0; die();
  } else {

      $httpcode = curl_getinfo($crl, CURLINFO_HTTP_CODE);
      echo " Http Code :".$httpcode;
      $result_data = json_decode($result);
      if($httpcode==200){

      $refinitiv['odatacontext']=$result_data->{'@odata.context'};
      $refinitiv['Notes']=json_encode($result_data->Notes);
      $this->db->insert("refinitiv", $refinitiv);

      $content_data = $result_data->Contents;
        print_r($content_data);
      foreach($content_data as $value){
          //$highh=$value->High;
          //if(($highh==(-9999401))||($highh==(-9999402)))
          //continue;
          $content["IdentifierType"]=$value->IdentifierType;
          $content["Identifier"]=$value->Identifier;
          $content["High"]=$value->High;
          $content["RIC"]=$value->RIC;
          $content["`UniversalClosePrice`"]=$value->{'Universal Close Price'};
          $content["Low"]=$value->Low;
          $content["TradeDate"]=$value->{'Trade Date'};
          $content["Volume"]=$value->Volume;
          $content["Open"]=$value->Open;
          $content["Last"]=$value->Last;
         $this->db->insert("refinitiv5year", $content);
         echo $this->db->last_query();
      }

      }
      else if($httpcode==202){

        $flag_code=false;
        while($flag_code){
        $location = $result_data->location;
        $ch = curl_init($location);
        $options = [CURLOPT_HEADER => true, CURLOPT_NOBODY => true, CURLOPT_RETURNTRANSFER => true ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata',
       'Prefer:respond-async',
        'Content-Type:application/json',
        'Authorization:Token '.$auth_key));
        $newdata = curl_exec($ch);
        $httpcodec = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($httpcodec==200){
            $newdata = json_decode($newdata);
            $job_id = $newdata->job_id;
            $main_url = "https://selectapi.datascope.refinitiv.com/RestApi/v1/Extractions/RawExtractionResults('JobID')/$job_id";
            $flag_code=true;
            break;
        }

        }
      }

       }

curl_close($crl);
  }



public function getrefinitive5yeardata($auth_key=""){
try {
    $startdate = date("Y-m-d", strtotime(date("Y-m-d").""));
    $enddate = date("Y-m-d");
    $post_data = str_replace("encodedend", "$enddate", str_replace("encodedstart", "$startdate", $this->datareqset));
    $data = json_decode($post_data);
    $newdata = $data->ExtractionRequest->IdentifierList->InstrumentIdentifiers;
    $varcount = 0;


    foreach($newdata as $value){
        $varcount++;
        //if($varcount==2)
        //break;
        $identifierType =$value->IdentifierType;
        $identifier =$value->Identifier;
        $datarequest = '{
    "ExtractionRequest": {
        "@odata.type": "#DataScope.Select.Api.Extractions.ExtractionRequests.ElektronTimeseriesExtractionRequest",
        "ContentFieldNames": [
            "High",
            "RIC",
            "Universal Close Price",
            "Low",
            "Trade Date",
            "Volume",
            "Open",
            "Last"
        ],
        "IdentifierList": {
            "@odata.type": "#DataScope.Select.Api.Extractions.ExtractionRequests.InstrumentIdentifierList",
            "InstrumentIdentifiers": [
                {
                    "IdentifierType": "'.$identifierType.'",
                    "Identifier": "'.$identifier.'"
                }
            ],
            "ValidationOptions": {
                "AllowHistoricalInstruments": true,
                "AllowInactiveInstruments": true
            },
            "UseUserPreferencesForValidationOptions": "false"
        },
        "Condition": {
            "ReportDateRangeType": "Range",
            "QueryStartDate": "'.date("Y-m-d", strtotime(date("Y-m-d")." -5 years")).'",
            "QueryEndDate": "'.date("Y-m-d").'",
            "LastEntityOnly": "false"
        }
    }
}';
    $post_data = $datarequest;
    $main_url = 'https://selectapi.datascope.refinitiv.com/RestApi/v1/Extractions/ExtractWithNotes';
    $http_sign = false;

  $crl = curl_init($main_url);
  curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($crl, CURLINFO_HEADER_OUT, true);
  curl_setopt($crl, CURLOPT_POST, true);
  curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($crl, CURLOPT_FAILONERROR, true);
  // Set HTTP Header for POST request
  curl_setopt($crl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata',
       'Prefer:respond-async',
        'Content-Type:application/json',
        'Authorization:Token '.$auth_key
  ));

  // Submit the POST request
  $result = curl_exec($crl);

  $httpcode = curl_getinfo($crl, CURLINFO_HTTP_CODE);
      echo " Http Code :".$httpcode;
      $result_data = json_decode($result);
      if($httpcode==200){


      $refinitiv['odatacontext']=$result_data->{'@odata.context'};
      $refinitiv['Notes']=json_encode($result_data->Notes);


      $content_data = $result_data->Contents;

      foreach($content_data as $value){
          $content["IdentifierType"]=$value->IdentifierType;
          $content["Identifier"]=$value->Identifier;
          $content["High"]=$value->High;
          $content["RIC"]=$value->RIC;
          $content["`UniversalClosePrice`"]=$value->{'Universal Close Price'};
          $content["Low"]=$value->Low;
          $content["TradeDate"]=$value->{'Trade Date'};
          $content["Volume"]=$value->Volume;
          $content["Open"]=$value->Open;
          $content["Last"]=$value->Last;
         $this->db->insert("refinitiv_5year_content", $content);


      }


      }


print_r($result);

curl_close($crl);
    }
    //$httpcode = curl_getinfo($crl, CURLINFO_HTTP_CODE);


    //return " Http Code :".$httpcode;
}
catch (\Error $e) {
   print_r($e);
}
}


public function getricrequest(){
    $reqstr = '{
    "ExtractionRequest": {
        "@odata.type": "#DataScope.Select.Api.Extractions.ExtractionRequests.TickHistoryIntradaySummariesExtractionRequest",
        "ContentFieldNames": [
            "Close Ask",
            "Close Bid",
            "High",
            "High Ask",
            "High Bid",
            "Last",
            "Low",
            "Low Ask",
            "Low Bid",
            "No. Asks",
            "No. Bids",
            "No. Trades",
            "Open",
            "Open Ask",
            "Open Bid",
            "Volume"
        ],
        "IdentifierList": {
            "@odata.type": "#DataScope.Select.Api.Extractions.ExtractionRequests.InstrumentIdentifierList",
            "InstrumentIdentifiers": [
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1060.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1080.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1120.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1140.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1150.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1180.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1182.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1201.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1202.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1210.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1211.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1212.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1213.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1214.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1301.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1302.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1303.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1304.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1320.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1810.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1820.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1830.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1831.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "1832.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2001.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2002.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2060.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2070.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2080.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2081.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2090.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2100.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2110.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2120.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2130.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2140.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2150.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2160.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2170.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2180.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2190.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2200.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2210.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2220.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2222.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2230.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2240.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2250.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2270.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2280.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2290.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2300.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2310.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2320.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2330.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2340.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2350.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2360.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2370.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "2380.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3001.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3003.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3004.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3005.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3007.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3008.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3060.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3080.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3090.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "3091.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4001.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4002.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4003.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4005.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4006.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4007.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4008.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4009.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4011.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4012.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4013.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4031.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4051.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4061.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4070.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4080.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4090.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4100.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4110.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4130.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4140.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4141.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4150.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4161.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4170.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4180.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4190.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4191.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4200.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4210.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4220.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4230.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4240.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4250.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4260.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4261.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4270.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4280.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4290.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4291.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4292.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4300.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4310.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4320.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4321.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4330.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4331.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4332.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4333.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4334.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4335.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4336.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4337.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4338.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4339.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4340.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4342.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4344.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4345.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4346.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4347.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4348.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4700.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "5110.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6001.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6002.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6004.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6012.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6060.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6070.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "6090.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7200.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "7201.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8010.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8012.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8020.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8030.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8040.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8050.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8060.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8070.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8080.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8100.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8110.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8120.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8130.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8150.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8160.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8170.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8180.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8190.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8200.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8210.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8230.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8240.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8250.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8260.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8270.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8280.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8300.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8310.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8311.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "8312.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9400.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9401.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9402.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9403.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9404.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9405.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9501.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9510.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9511.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9512.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9513.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9514.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9515.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9516.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9517.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9518.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9519.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "9520.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AAN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AGLT.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AIRA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AJBNK.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALFH.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALL.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALRAMZ.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMAN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMANT.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMCREIT.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMLK.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARMX.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARTC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ASCI.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ASNC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BHMCAPITAL.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CBD.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CHAE.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CHAESHIN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DAMAC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DEYR.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DFM.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DINC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DINV.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DISB.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DNIN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DRC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DSI.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DTKF.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DU.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DXBE.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EIB.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EIBAN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EKTT.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EMAA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EMAARDEV.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EMAR.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ENBD.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ERC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GFH.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GGIC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GNAV.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GULFA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IFIN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ITHMR.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MADI.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MARKA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MASB.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MAZA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NAHO.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NCC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NGIN.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NIH.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NIND.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OIC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ORIENT.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OUTFL.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SAGH.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SALAM.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SALAMA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHUA.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SSUD.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TABR.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TKFE.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UFC.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UNIK.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UPRO.DU"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABNIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADAVIATION.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADCB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADIB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADNH.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADNIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADNOCDIST.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ADSB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AFNIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AGTHIA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AKIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALAIN.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALDAR.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALPHADHABI.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ANAN.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARKAN.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ASM.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AWNIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BILDCO.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BOS.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CBI.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CHAEIN.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CHAESH.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DANA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DHAFRA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DRIVE.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EASYLEASE.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ESG.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ESHRAQ.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ETISALAT.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FAB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FBI.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FCI.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FH.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FIDELITYUNITED.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FNF.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FOODCO.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GCEM.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GCIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GMPC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IH.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IHC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "INVESTB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "JULPHAR.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KICO.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MANAZEL.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "METHAQ.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NBF.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NBQ.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NCTH.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NMDC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OEIHC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ORDS.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PALMS.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKBANK.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKCC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKCEC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKNIC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKPROP.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAKWCT.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RAPCO.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "REEM.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RPM.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SAWAEED.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SCIDC.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SG.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SIB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SICO.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SUDATEL.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TAQA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TKFL.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TNI.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UAB.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UNION.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WAHA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WATANIA.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "YAHSAT.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ZS.AD"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "VOES.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "VISN.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UFCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UECP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UBAR.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TFCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TAOI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SUWP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SSPW.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SPSI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SPFI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SOMS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SOMP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SMNP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SIHC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHRQ.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHPS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHCS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SFMI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SAHS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RNSS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RCCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PHPC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PCLI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OUIC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OTEL.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OSCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ORDS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ORCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OQIC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OPCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OOMS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OOMP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ONES.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OMVS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OMRF.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OMCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OIMS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OIFC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OFMI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OFCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OETI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OEIO.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OEFI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OCOI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OCHL.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OCCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OCAI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OAB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NRED.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NMWI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NLIF.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NHIS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NGCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NFCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NDTI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NBOB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NBII.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NAPI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MTMI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MSPW.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MJI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MHAS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MGMC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MGCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MFCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MCTI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MCDE.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KPCS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HMCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HECI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HBMO.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GSCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GMPI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GICI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GHOS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GFIC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GECS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GECP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FSCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FINC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DTCS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DPCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DMGI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DIDI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DICS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DGEN.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DFII.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DCFI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DBIH.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DBCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CSII.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CMII.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKSB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKNZ.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKMB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKDB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BATP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BAHS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BACS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ATMI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "APBS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AOFS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMII.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMCI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMAT.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMAN.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AKPI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AJSS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AJSP.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AINS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AFIC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AFAI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABOB.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABMI.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABHS.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AAIC.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AACT.OM"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AABQ.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AHCS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BLDN.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BLDNf.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BRES.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "COMB.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DBIS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DICO.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DOBK.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ERES.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FALH.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FALHf.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GISS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GWCS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IGRD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IHGS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IQCD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KCBK.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KINS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MARK.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MCCS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MCGS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MERS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MKDM.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MKDMf.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MPHC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MRDS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NLCS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ORDS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QAMC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QANC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QATR.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QCFD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QETF.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QEWC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QFBQ.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QFLS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QGIR.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QGMS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QGTS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIGD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIIB.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIIC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIMC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QINS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QISB.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QLMI.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QNBK.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QNNC.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QOIS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SALM.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UDCD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "VFQS.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WDAM.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ZHCD.QA"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AAN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AAYA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABAR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ACIC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AGHC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AGLT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AINS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AJWN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALAF.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALAQ.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALEID.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALIMK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALMAN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALMK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALQK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMAR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AMARF.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AQAR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARAB.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AREC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARGK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARZA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ASCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ASIYA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ATCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AUBK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AYRE.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AZNOULA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BAITAKREIT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BAREEQ.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BAYK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKIK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKME.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BOUK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BOURSA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BPCC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BURG.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CABL.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CATT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CBKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CGCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "CLEA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "COAS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DALQ.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "DEER.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EDUK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EKHK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EKTT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ENER.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ENMA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "EQUI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FACI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FCEM.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FIRST.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "FTIK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GBKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GFCI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GFHK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GIHK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GINS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GNAH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "GPIK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HAYK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HCCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "HUMN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IFAH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IFIN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "INJA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "INOV.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "INTG.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "INVK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "IPGK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "JAZK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "JIYAD.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KAMC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KBTK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KCEM.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KCIN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KCPC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KFDC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KFH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KFSK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KGLK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KHOT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KIBK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KIDK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KINS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KINV.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KMEF.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KPPC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KPRO.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KREK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KSHC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "KWRE.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "LAND.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "LOGK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MABK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MADI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MADR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MALK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MANK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MARA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MARKZ.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MASH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MASKN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MAZA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MBRD.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MENK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MEZZ.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MIDAN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MRCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MREC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MUNK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "MUNS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NAPS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NBKK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NCCI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NIBM.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NIHK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NIND.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NINV.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NOOR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "NREK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OLAK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OORE.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OSOS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OSUL.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "OULA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PAPE.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PAPK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "PCEM.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "QIC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "REAM.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "REMAL.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "RKWC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SAGH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SALB.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SANK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SCFK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SECH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SENE.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHCK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHIP.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SHOT.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SOOR.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SPEC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "SREK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "STC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TAHS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TAMI.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TAMK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "THURY.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TIJA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "TIJK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UNIC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UPAC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "UREK.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WARB.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WARBA.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WETH.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "WINS.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "YIAC.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ZAIN.KW"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "4004.SE"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ABCB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ALBH.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "APMTB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "ARIG.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "AUBB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BANA.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BARKA.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BBKB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BCFC.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BFMC.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BISB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BKIC.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BMEB.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BMMI.BH"
                },
                {
                    "IdentifierType": "Ric",
                    "Identifier": "BMUS.BH"
                }
            ],
            "ValidationOptions": null,
            "UseUserPreferencesForValidationOptions": false
        },
        "Condition": {
            "MessageTimeStampIn": "GmtUtc",
            "ReportDateRangeType": "Range",
            "QueryStartDate": "'.date("Y-m-d").'T00:00:00.000Z",
            "QueryEndDate": "'.date("Y-m-d").'T00:00:00.000Z",
            "SummaryInterval": "OneHour",
            "TimebarPersistence": true,
            "DisplaySourceRIC": true
        }
    }
}';
        return $reqstr;
}


}
