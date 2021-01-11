<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gchart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('gcharts');
    }

    public function index()
    {
        $this->load->view('gcharts/index');
    }

	public function phChart()
    {
        $this->gcharts->load('LineChart');
        
        $this->gcharts->DataTable('Stocks')
        ->addColumn('number', 'Count', 'count')
        ->addColumn('number', 'Projected', 'projected')
        ->addColumn('number', 'Official', 'official');
        
        for($a = 1; $a < 25; $a++)
        {
	        $data = array(
	        	$a,             //Count
	        	rand(800,1000), //Line 1's data
	        	rand(800,1000)  //Line 2's data
	        	);
        
        	$this->gcharts->DataTable('Stocks')->addRow($data);
        }
        
        $config = array(
        	'title' => 'Stocks'
        );
        
        $this->gcharts->LineChart('Stocks')->setConfig($config);
        

        $this->gcharts->DataTable('ph')
             ->addColumn('date', 'Dates', 'dates')
             ->addColumn('number', 'PH', 'ph');
		
        // get data from method
        
        $boiaMarcada = $this->input->get_post('boiaMarcada');
        $parametroRecebido = $this->input->get_post('parametroLink');
        $this->load->model('fundeio');
        $boia = new Fundeio();
        
        // colect data
        $qnt = 8;
        $this->load->model('parametros');
        $infoparametro = new Parametros();
        $temp = $infoparametro->getMedicaoParametroBoia($parametroRecebido,$qnt,$boiaMarcada);
         
        // define o período
        for($a = 1; $a < $qnt; $a++)
        {
            $data = array(
                new jsDate(2013, 8, $a), //Data do Objeto
                $temp[$a],              //Linha do dado
            );

            $this->gcharts->DataTable('ph')->addRow($data);
        }

        //Either Chain functions together to set configuration options
        $titleStyle = $this->gcharts->textStyle()
                                    ->color('#FF0A04')
                                    ->fontName('Georgia')
                                    ->fontSize(18);

        $legendStyle = $this->gcharts->textStyle()
                                     ->color('#F3BB00')
                                     ->fontName('Arial')
                                     ->fontSize(20);

        $legend = $this->gcharts->legend()
                                ->position('bottom')
                                ->alignment('start')
                                ->textStyle($legendStyle);

        //Or pass an array with the configuration options into the function
        $tooltipStyle = new textStyle(array(
                        'color' => '#C0C0B0',
                        'fontName' => 'Courier New',
                        'fontSize' => 10
                    ));

        $tooltip = new tooltip(array(
                        'showColorCode' => TRUE,
                        'textStyle' => $tooltipStyle
                    ));


        $config = array(
            'backgroundColor' => new backgroundColor(array(
                'stroke' => '#BBBBBB',
                'strokeWidth' => 8,
                'fill' => '#EFEFFF'
            )),
            'chartArea' => new chartArea(array(
                'left' => 100,
                'top' => 75,
                'width' => '85%',
                'height' => '55%'
            )),
            'titleTextStyle' => $titleStyle,
            'legend' => $legend,
            'tooltip' => $tooltip,
 // Nome da Tabela + boia (ideia)       		
            'title' => 'Boia Simcosta SP',
            'titlePosition' => 'out',
            'curveType' => 'function',
            'width' => 1000,
            'height' => 450,
            'pointSize' => 3,
            'lineWidth' => 1,
            'colors' => array('#4F9CBB', 'green'),
            'hAxis' => new hAxis(array(
                'baselineColor' => '#fc32b0',
                'gridlines' => array(
                    'color' => '#43fc72',
                    'count' => 6
                ),
                'minorGridlines' => array(
                    'color' => '#b3c8d1',
                    'count' => 3
                ),
                'textPosition' => 'out',
                'textStyle' => new textStyle(array(
                    'color' => '#C42B5F',
                    'fontName' => 'Tahoma',
                    'fontSize' => 10
                )),
                'slantedText' => TRUE,
                'slantedTextAngle' => 30,
  // Nome Haxis
                'title' => 'Período',
                'titleTextStyle' => new textStyle(array(
                    'color' => '#BB33CC',
                    'fontName' => 'Impact',
                    'fontSize' => 14
                )),
                'maxAlternation' => 6,
                'maxTextLines' => 2
            )),
            'vAxis' => new vAxis(array(
                'baseline' => 1,
                'baselineColor' => '#CF3BBB',
                'format' => '## hrs',
                'textPosition' => 'out',
                'textStyle' => new textStyle(array(
                    'color' => '#DDAA88',
                    'fontName' => 'Arial Bold',
                    'fontSize' => 10
                )),
   // Nome Vaxis
                'title' => 'Ph',
                'titleTextStyle' => new textStyle(array(
                    'color' => '#5C6DAB',
                    'fontName' => 'Verdana',
                    'fontSize' => 14
                )),
            ))
        );

        $this->gcharts->LineChart('ph')->setConfig($config);

        $this->load->view('gcharts/phCHart');
    }
    
}

/* End of file gchart_examples.php */
/* Location: ./application/controllers/gchart_examples.php */