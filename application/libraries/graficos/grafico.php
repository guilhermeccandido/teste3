<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* pChart library inclusions */
include("class/pData.class.php");
include("class/pDraw.class.php");
include("class/pImage.class.php");
include("class/pRadar.class.php");

/**
 * Classe que utiliza a biblioteca pChart para a elaboracao de graficos
 * @link http://www.pchart.net/
 */
class Grafico
{
    private $tituloGrafico;
    private $alturaGrafico = 230;
    private $larguraGrafico = 693;
    private $transparencia = false;
    private $eixoX = array();
    private $eixoY = array();
    private $tituloEixoX;
    private $descricaoSerie;
    private $conjuntoDescricaoSerie;
    private $ligarAntialias;
    private $tamanhoFonte = 8;
    private $fundoQuadriculado = true;
    public  $pathGrafico = null;
    private $larguraArea = 650;
    private $alturaArea = 200;
    private $margemEsquerda = 40;
    private $margemSuperior = 25;
    private $legendaX = 660;
    private $legendaY = 50;
    private $legenda = true;
    private $grafBarra = false;
    private $grafLinha = false;
    private $pontosGrafico = true;
    private $seriesDiferentes = false; 
    private $margemTituloEsq = 70;
    private $margemTituloSup = 25;
    private $tamanhoTitulo = 11;
    private $rotacaoLabels = 0;
    private $tituloRodape;
    private $plotSize = 2;
    private $setaComTamanho = true;
    private $linhasPontos = true;
    
    
    public function __contruct()
    {                
        $this->ligarAntialias = false;
    }
    
    public function setTituloGrafico($texto)
    {
        $this->tituloGrafico = $texto;
    }
    
    public function getTituloGrafico()
    {
        return $this->tituloGrafico;
    }
    
    /**
     * Determina altura da figura do grafico.
     * @param int altura
     */
    public function setAlturaGrafico($altura)
    {
        $this->alturaGrafico = $altura;
    }
    
    public function getAlturaGrafico()
    {
        return $this->alturaGrafico;
    }
    
    /**
     * Determina a largura da figura do grafico.
     * @param int $largura
     */
    public function setLarguraGrafico($largura)
    {
        $this->larguraGrafico = $largura;
    }
    
    public function getLarguraGrafico()
    {
        return $this->larguraGrafico;
    }
    
    /**
     * Pontos a serem informados para o eixo X.
     * @param array $conjuntoX
     */
    public function setEixoX($conjuntoX)
    {
        $this->eixoX = $conjuntoX;
    }
    
    public function getEixoX()
    {
        return $this->eixoX;
    }
    
    /**
     * Valores a serem informados para o eixo Y.
     * @param array $conjuntoY
     */
    public function setEixoY($conjuntoY)
    {
        $this->eixoY = $conjuntoY;
    }
    
    public function getEixoY()
    {
        return $this->eixoY;
    }
    
    /**
     * Titulo para eixo X
     * @param string $tituloX
     */
    public function setTituloEixoX($tituloX)
    {
        $this->tituloEixoX = $tituloX;
    }
    
    public function getTituloEixoX()
    {
        return $this->tituloEixoX;
    }
    
    /**
     * Nome para a descricao da serie
     * @param string $descricaoSerie
     */
    public function setDescricaoSerie($descricaoSerie)
    {
        $this->descricaoSerie = $descricaoSerie;
    }
    
    public function getDescricaoSerie()
    {
        return $this->descricaoSerie;
    }
    
    public function setConjuntoDescricaoSerie($serie)
    {
        $this->conjuntoDescricaoSerie = $serie;
    }
    
    public function getConjuntoDescricaoSerie()
    {
        return $this->conjuntoDescricaoSerie;
    }
    
    /**
     * Configura paraTRUE ou FALSE o filtro anti-alias (serrilhamento) do grafico.
     * @param boolean $antialias
     */
    public function setAntialias($antialias)
    {
        $this->ligarAntialias = $antialias;
    }
    
    public function getAntialias()
    {
        return $this->ligarAntialias;
    }
    
    public function setTituloRodape($txt)
    {
        $this->tituloRodape = $txt;
    }
    
    public function getTituloRodape()
    {
        return $this->tituloRodape;
    }
    
    /**
     * Tamanho geral da fonte utilizada nos dados do gráfico
     * @param float $tamanhoFonte
     */
    public function setTamanhoFonte($tamanhoFonte)
    {
        $this->tamanhoFonte = $tamanhoFonte;
    }
    
    public function getTamanhoFonte()
    {
        return $this->tamanhoFonte;
    }
    
    /**
     * Configura fundo transparente do grafico, FALSE como padrão.
     * @param boolean $transparente
     */
    public function setTransparencia($transparente)
    {
        $this->transparencia = $transparente;
    }
    
    public function getTransparencia()
    {
        return $this->transparencia;
    }
    
    /**
     * Configura caminho completo do arquivo (caminho + nome.extensao). Use PNG.
     * @param string $path
     */
    public function setCaminhoArquivo($path)
    {
        $this->pathGrafico = $path;
    }
    
    public function getCaminhoArquivo()
    {
        return $this->pathGrafico;
    }
    
    /**
     * Define a largura de dados para o grafico
     * @param int $largura
     */
    public function setLarguraArea($largura)
    {
        $this->larguraArea = $largura;    
    }
    
    public function getLarguraArea()
    {
        return $this->larguraArea;
    }
    
    /**
     * define a altura da area de dados do grafico
     * @param int $altura
     */
    public function setAlturaArea($altura)
    {
        $this->alturaArea = $altura; 
    }
    
    public function getAlturaArea()
    {
        return $this->alturaArea;
    }
    
    public function setMargemEsquerdaGrafico($margem)
    {
        $this->margemEsquerda = $margem;
    }
    
    public function getMargemEsquerdaGrafico()
    {
        return $this->margemEsquerda;
    }
    
    public function setMargemSuperiorGrafico($margem)
    {
        $this->margemSuperior = $margem;
    }
    
    public function getMargemSuperiorGrafico()
    {
        return $this->margemSuperior;
    }
    
    public function setTamanhoTituloGrafico($tamanho)
    {
        $this->tamanhoTitulo = $tamanho;
    }
    
    public function getTamanhoTituloGrafico()
    {
        return $this->tamanhoTitulo;
    }
    
    /**
     * Define posicao no eixo X para a legenda
     * @param int $posicao
     */
    public function setLegendaX($posicao)
    {
        $this->legendaX = $posicao;
    }
    
    public function getLegendaX()
    {
        return $this->legendaX;
    }
    
    /**
     * Define posicao no eixo Y para a legenda
     * @param int $posicao
     */
    public function setLegendaY($posicao)
    {
        $this->legendaY = $posicao;
    }
    
    public function getLegendaY()
    {
        return $this->legendaY;
    }
    
    /**
     * Define se grafico tem legenda ou nao
     * @param boolean $opcao o padrao é true
     */
    public function setLegenda($opcao)
    {
        $this->legenda = $opcao;
    }
    
    public function isGraficoLinha(){
        return $this->grafLinha;
    }
    
    public function isGraficoBarra(){
        return $this->grafBarra;
    }

    public function setGraficoLinha($valor){
        $this->grafLinha = $valor;
    }
    
    public function setGraficoBarra($valor){
        $this->grafBarra = $valor;
    }
    
    /**
     * Exibe pequenas esferas que destacam os pontos marcados.
     * @param boolean $ponto
     */
    public function setPontoGrafico($ponto)
    {
        $this->pontosGrafico = $ponto;   
    }
    
    public function getPontoGrafico()
    {
        return $this->pontosGrafico;
    }
    
    /**
     * Se o grafico possuir series diferentes (da qual os valores nao constam na mesma unidade), use 
     * esta funcao para avisar ao grafico para que este considere como series diferentes.
     * @param int $opcao
     */
    public function setSerieDiferente($opcao)
    {
        $this->seriesDiferentes = $opcao;
    }
    
    public function getSerieDiferente()
    {
        return $this->seriesDiferentes;
    }
    
    /**
     * Posição do titulo a esquerda em referencia a margem esquerda
     * @param int $valor
     */
    public function setMargemTituloEsq($valor)
    {
        $this->margemTituloEsq = $valor;
    }
    
    /**
     * Altura do titulo do grafico
     * @param int $valor
     */
    public function setMargemTituloSup($valor)
    {
        $this->margemTituloSup = $valor;
    }
    
    /**
     * Detemrina a rotacoa, em graus, dos labels no eixo X
     * @param int $valor
     */
    public function setRotacaoLabels($valor)
    {
        $this->rotacaoLabels = $valor;
    }
    
    public function getRotacaoLabels()
    {
        return $this->rotacaoLabels;
    }
    
    public function setPlotSize($valor)
    {
		$this->plotSize = $valor;
	}
	
	public function getPlotSize()
	{
		return $this->plotSize;
	}

	public function setSetaComTamanho($valor)
	{
		$this->setaComTamanho = $valor;
	}

	public function getSetaComTamanho($valor)
	{
		return $this->setaComTamanho;
	}
	
	public function setLinhasPontos($valor)
	{
	    $this->linhasPontos = $valor;
	}
	
	public function getLinhasPontos()
	{
	    return $this->linhasPontos;
	}

    /**
     * Metodo que realiza as ultimas configuracoes e renderiza o grafico de linhas.
     * @return renderiza o grafico se nenhum erro ocorrer, false do contrario
     */
    public function graficoLinha()
    {
    	$this->setCaminhoArquivo(GRAFICOSGERADOS.'graficoparam.png');
        $quantidadeEixoX = count($this->eixoX);
        if($quantidadeEixoX == 0) return false;
        if(count($this->eixoY) == 0) return false;             
        
        $myData = new pData();
        
        $valor = array();
        //adicionando pontos em relacao ao eixo X
        for($i=0; $i < $quantidadeEixoX; $i++){
 
            $valor = $this->eixoX[$i]['valores'];
            
            for($j=0;$j< count($valor); $j++){
                if ($valor[$j] == "VOID") {
                   $valor[$j] = VOID;
                }           
            }
             
            $myData->addPoints($valor,$this->eixoX[$i]['nomeSerie']);
            //$myData->setSeriePicture($this->eixoX[$i]['nomeSerie'],'/var/www/portal/images/pagina/read.png');            
            
            if($this->seriesDiferentes){
                $myData->setSerieOnAxis($this->eixoX[$i]['nomeSerie'],$i);
                $myData->setAxisName($i, $this->eixoX[$i]['nomeSerie']);           
            }
            
            
            if($this->seriesDiferentes && $i == 0){                
        
                $myData->setAxisColor($i,array("R"=>0,"G"=>0,"B"=>0,"Alpha"=>100));
                $myData->setPalette($this->eixoX[$i]['nomeSerie'],array("R"=>0,"G"=>0,"B"=>0,"Alpha"=>100));
            }
            if($this->seriesDiferentes && $i > 0){
                
                $myData->setAxisColor($i,array("R"=>77,"G"=>0,"B"=>255,"Alpha"=>100));
                $myData->setPalette($this->eixoX[$i]['nomeSerie'],array("R"=>77,"G"=>0,"B"=>255,"Alpha"=>100));
            }
            
            if(!$this->seriesDiferentes){
                $myData->setPalette($this->eixoX[$i]['nomeSerie'],$this->eixoX[$i]['cor']); //cor da linha
            }
            
            //$myData->setSerieOnAxis($this->eixoX[$i]['nomeSerie'], 0); //nao precisa bindar com 0 por ser a serie default
            
        }
                
        //$myData->setAxisUnit(0, 'ºC');
        //$myData->setAxisDisplay(0,AXIS_FORMAT_METRIC);
        
        //adicionando informacao sobre eixo Y
        $myData->addPoints($this->eixoY,"Labels");                
        $myData->setSerieDescription("Labels",$this->descricaoSerie);
        $myData->setAbscissa("Labels");
        
        
        //desenhando
        $myPicture = new pImage($this->larguraGrafico,$this->alturaGrafico,$myData,$this->transparencia); //largura,altura,dados,transparencia
        //http://wiki.pchart.net/doc.draw.arrows.html        
        //$myPicture->drawArrow(60,235,0,30,array("FillR"=>1*2.5,"FillG"=>1*2.5,"FillB"=>1*2.5,"Ticks"=>0));
        //adicionando borda a imagem
       // $myPicture->drawRectangle(0,0,0,0,array("R"=>0,"G"=>0,"B"=>0));
        
        //fonte padrao e titulo
        $myPicture->setFontProperties(array("FontName"=>PORTALFONTS."verdana.ttf","FontSize"=> $this->tamanhoFonte));        
        $myPicture->drawText($this->margemTituloEsq,$this->margemTituloSup,"".$this->tituloGrafico,array("FontSize"=>$this->tamanhoTitulo,"Align"=>TEXT_ALIGN_BOTTOMLEFT)); //titulo grafico
                
        /* Define the chart area */
        //$myPicture->setGraphArea(45,25,650,200); //margin-left,margin-up,Largura,Altura
        //margin-left,margin-up,Largura,Altura
        $myPicture->setGraphArea($this->margemEsquerda,$this->margemSuperior,$this->larguraArea,$this->alturaArea);
               
        /* Draw the scale */
        $scaleSettings = array(
                "XMargin"=>8,
                "YMargin"=>8,
                "Floating"=>TRUE,
                "GridR"=>200,
                "GridG"=>200,
                "GridB"=>200,
                "DrawSubTicks"=>TRUE,
                "CycleBackground"=>TRUE,
                "LabelRotation"=>$this->rotacaoLabels,                
                "ScaleSpacing"=>12,
                "Mode"=>SCALE_MODE_FLOATING,

        );
        $myPicture->drawScale($scaleSettings);
        $myPicture->Antialias = TRUE;
        

        if (!$this->isGraficoBarra() && !$this->isGraficoLinha() ) {
           if($this->pontosGrafico) $myPicture->drawPlotChart();
           if($this->linhasPontos) $myPicture->drawSplineChart();  //desenho das linhas           
        }
        if ($this->isGraficoBarra()) {
            $myPicture->drawBarChart();
            if($this->pontosGrafico) $myPicture->drawPlotChart();
            $myPicture->writeBounds(); //maximo e minimo        
            
        }
        if ($this->isGraficoLinha()) {
          
           $myPicture->drawSplineChart();            
           if($this->pontosGrafico) $myPicture->drawPlotChart();
           $myPicture->writeBounds();
                     
        }
        
        /* Write the chart legend */
        if($this->legenda) $myPicture->drawLegend($this->legendaX,$this->legendaY,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_VERTICAL));                
        
        /* Render the picture (choose the best way) */
        //$myPicture->autoOutput("../../../images/grafico.png");
        $myPicture->Render($this->pathGrafico);
        //$myPicture->stroke();
    }
    
    /**
     * Metodo para desenvolver grafico de linhas e em cada ponto utilizar setas com determinados angulos.
     * Esta função deve ser utilizada para gráficos com direção e velocidade de vento, por exemplo.
     * @param int $posicaoDirecao posicao do vetor eixo X da qual consta os angulos
     * @param int $posicaoVelocidade posicao do vetor eixo X da qual consta a intensidade
     * @param int $fatorAumentoSetas valor para aumentar as setas, melhor visiblidade no grafico
     * @param int $fatorTamanhoSetaZero tamanho da seta quando a intensidade esta proximo ou igual a zero, melhor visibilidade de seta
     * @return boolean|resource false em caso de problemas ou gera o grafico no path especificado.
     */
    public function graficoSetas($posicaoDirecao,$posicaoVelocidade,$fatorAumentoSetas=null,$fatorTamanhoSetaZero=null)
    {
    	$this->setCaminhoArquivo(GRAFICOSGERADOS.'graficoparam.png');
        $quantidadeEixoX = count($this->eixoX);        
        if($quantidadeEixoX == 0) return false;        
        if(count($this->eixoY) == 0) return false;                

        $myData = new pData();
        $valor = array();
        $direcoes = array();
        $intensidade = array();
        //adicionando pontos em relacao ao eixo X
        for($i=0; $i < $quantidadeEixoX; $i++){
        
            $valor = $this->eixoX[$i]['valores'];
        
            for($j=0;$j< count($valor); $j++){
                if ($valor[$j] == "VOID") {
                    $valor[$j] = VOID;
                }
            }        
        
            if($i==$posicaoDirecao) $direcoes = $valor;            
        
            if($i==$posicaoVelocidade){  
                
                $intensidade = $valor;
        
                $myData->addPoints($valor,$this->eixoX[$i]['nomeSerie']);                
                $myData->setAxisName(0, $this->eixoX[$i]['nomeSerie']);
                $myData->setPalette($this->eixoX[$i]['nomeSerie'],$this->eixoX[$i]['cor']); //cor da linha   
                //$myData->setSerieWeight($this->eixoX[$i]['nomeSerie'],1);  //tamanho marcacao da linha           
                
            }        
        }
        
        //adicionando informacao sobre eixo Y
        $myData->addPoints($this->eixoY,"Labels");
        $myData->setSerieDescription("Labels",$this->descricaoSerie);
        $myData->setAbscissa("Labels");    
        
        
        //desenhando        
        $this->alturaGrafico += 20;
        $this->larguraGrafico +=50; //espaco para setas que apontam para leste
        $myPicture = new pImage($this->larguraGrafico,$this->alturaGrafico,$myData,$this->transparencia); //largura,altura,dados,transparencia
        
        //fonte padrao e titulo
        $myPicture->setFontProperties(array("FontName"=>PORTALFONTS."verdana.ttf","FontSize"=> 8));
        $myPicture->drawText($this->margemTituloEsq,$this->margemTituloSup,"".$this->tituloGrafico,array("FontSize"=>11,"Align"=>TEXT_ALIGN_BOTTOMLEFT)); //titulo grafico
        
        /* Define the chart area */
        //margin-left,margin-up,Largura,Altura      
        $myPicture->setGraphArea(68,$this->margemSuperior,$this->larguraArea,$this->alturaArea);
         
        /* Draw the scale */
        $scaleSettings = array(
            "XMargin"=>8,
            "YMargin"=>8,
            "Floating"=>TRUE,
            "GridR"=>200,
            "GridG"=>200,
            "GridB"=>200,
            "DrawSubTicks"=>TRUE,
            "CycleBackground"=>TRUE,
            "LabelRotation"=>$this->rotacaoLabels,
            "ScaleSpacing"=>12,
            "Mode"=>SCALE_MODE_FLOATING,
        
        );
        $myPicture->drawScale($scaleSettings);
        $myPicture->Antialias = TRUE;
        
        $altura = $myPicture->getHeight();
        $largura = $myPicture->getWidth();
        $quantidadeValores = count($direcoes);
        $ArrowWindSettings = array(
            "BorderSize"=>0,
            "Surrounding"=>40,
            "BorderAlpha"=>100,
            "PlotSize"=>$this->plotSize,
            "PlotBorder"=>FALSE,
            "DisplayValues"=>FALSE,
            "DisplayColor"=>DISPLAY_AUTO            
        );
        $posValores = $myPicture->drawArrowWind($ArrowWindSettings);
        //tamanho fixo, mas deve variar de acordo com o numero de pontos que o grafico mostrara
        for($l = 0; $l< $quantidadeValores; $l++){
        
            if( ($direcoes[$l] != VOID) && ($intensidade[$l] != VOID) ){

                $direcaoCorreta = $direcoes[$l] - 180;
                if($direcaoCorreta < 0) $direcaoCorreta *= -1;
                
                if( $fatorAumentoSetas == null ) $fatorAumentoSetas = 0;
                if( $fatorTamanhoSetaZero == null ) $fatorTamanhoSetaZero = 0;
                if($this->setaComTamanho) $velocidade = $intensidade[$l];
                if(!$this->setaComTamanho) $velocidade = null;
                $ArrowSettings = array(
                    "FillR"=>188,
                    "FillG"=>49,
                    "FillB"=>42,
                    "Length"=>30,
                    "Angle"=>$direcaoCorreta,
                    "Velocity"=>$velocidade, //se passar null, pchart ignora os fatores de tamanho abaixo
                    "FactorSizeArrow"=>$fatorAumentoSetas, //fator tamanho da seta
                    "MinFactor"=>1, //menor que este valor o fator tamanho eh somado, >= eh multiplicado
                    "ZeroFactor"=>$fatorTamanhoSetaZero, //para quando a velocidade for zerada, melhora estetica da seta sem velocidade
                    "Position"=>POSITION_TOP,
                    "Ticks"=>0,
                    "Size"=>4                    
                );
                //Converter Cada Ponto para radianos e converter para coordenadas polares
//                 $winddir = deg2rad($direcoes[$l]);
//                 $u = $intensidade[$l] * sin($winddir);
//                 $v = $intensidade[$l] * cos($winddir);
//                 echo 'windir = '.$direcoes[$l].' u = '.$u.' - v = '.$v.'<br>';
//                 $myPicture->drawArrow($posValores[0][$l],$posValores[1][$l],$u,$v,$ArrowSettings); //usar este ao inves do abaixo
                $myPicture->drawArrowLabel($posValores[0][$l],$posValores[1][$l],'',$ArrowSettings);
            }
        }
        
        if($this->grafLinha == true) $myPicture->drawSplineChart();  //desenho das linhas        
        $myPicture->writeBounds(); //maximo e minimo
                     
        /* Write the chart legend */
        if($this->legenda) $myPicture->drawLegend($this->legendaX,$this->legendaY,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_VERTICAL));

        $x = $this->alturaArea - 199;
        $y = $this->larguraArea - 30;        
        $myPicture->drawFromPNG($y,$x,PORTALIMAGES."pagina/rosa-ventos.png");
        if($this->tituloRodape != null) $myPicture->drawText(10,290,$this->tituloRodape,array("R"=>0,"G"=>0,"B"=>0,"FontSize"=>8,"Align"=>TEXT_ALIGN_BOTTOMLEFT));
        $myPicture->Render($this->pathGrafico);
        
    }
    
    
    /**
     * Metodo para testes com graficos radares/polares
     * @return boolean|resource false em casdo de problemas ou gera o grafico no path especificado
     */
    public function graficoRadar(){
        
    	$this->setCaminhoArquivo(GRAFICOSGERADOS.'graficoparam.png');
        $myDataRadar = new pData();
        $myDataPolar = new pData();
        
        if(count($this->eixoX) == 0){
            return false;
        }
        
        if(count($this->eixoY) == 0){
            return false;
        }
                
        
        $direcaoVento = array(160.31,64.68,81.56,78.75,348.75,336.09,354.37,1.40,4.21,19.68,1.4);
        $intensidadeVento = array(0.39,0.39,0,0,0,0.39,2.35,1.96,1.96,0.78,0.78);
        //SELECT dataReal,hora,direcaoVento,intensidadeVento FROM `meteorologicas-transmitidas-decodificadas` where id_fundeio = 11 and dataReal = '2014-04-04' and checksumConfere = 1 group by hora order by hora asc
        
        
        $arraySemDuplicacao = array();
        $arraySemDuplicacao = array_unique($this->eixoX[0]['valores']);
        $teste = array();
        $teste = array_unique(array(22.5,45,67.5,360,360,90,112.5,135,157.5,180,202.5,225,247.5,270,292.5,315,337.5));
        array_multisort($teste);
        $teste = array_reverse($teste);
        //adicionando pontos em relacao ao eixo X
        $myDataRadar->addPoints($intensidadeVento,$this->eixoX[0]['nomeSerie']);
        //$myDataRadar->addPoints($arraySemDuplicacao,$this->eixoX[0]['nomeSerie']);        
        //$myDataRadar->addPoints($this->eixoX[0]['valores'],$this->eixoX[0]['nomeSerie']);
        //$myDataRadar->addPoints(array_reverse(array(VOID,45,VOID,VOID,VOID,VOID,VOID,VOID,VOID,VOID,VOID,VOID,292.5,315,VOID,360)),$this->eixoX[0]['nomeSerie']);
        //$myDataRadar->addPoints(array(349,12,34,57,79,102,124,147,169,192,214,237,259,282,304,327),$this->eixoX[0]['nomeSerie']);
        $myDataRadar->setPalette($this->eixoX[0]['nomeSerie'],array("R"=>105,"G"=>105,"B"=>105,"Alpha"=>100)); //cor da linha
        
        //$myDataPolar->addPoints($this->eixoX[0]['valores'],$this->eixoX[0]['nomeSerie']);
        //$myDataPolar->addPoints($arraySemDuplicacao,$this->eixoX[0]['nomeSerie']);
        $myDataPolar->addPoints($intensidadeVento,$this->eixoX[0]['nomeSerie']);
        $myDataPolar->setPalette($this->eixoX[0]['nomeSerie'],array("R"=>105,"G"=>105,"B"=>105,"Alpha"=>100)); //cor da linha       
        
        //$teste = array();
        //$teste = array_unique($this->eixoX[0]['valores']);
        //adicionando informacao sobre eixo Y
        //$myDataRadar->addPoints(array('NNE','NE','ENE','E','ESE','SE','SSE','S','SSW','SW','WSW','W','WNW','NW','NNW','N'),"Card");
        //$myDataRadar->addPoints(array(22.5,45,67.5,90,112.5,135,157.5,180,202.5,225,247.5,270,292.5,315,337.5,360),"Card");
        //$myDataRadar->addPoints(array(360,90,180,270),"Card");
        //$myDataRadar->addPoints($arraySemDuplicacao,"Card");
        //$myDataRadar->addPoints(array(349,12,34,57,79,102,124,147,169,192,214,237,259,282,304,327),"Card");
        //$myDataRadar->addPoints(array(360,45,90,135,180,225,270,315),"Card");
//         $myDataRadar->addPoints(array(360,10,20,30,40,50,60,70,80,90,100,110,120,130,140,150,160,170,180,190,200,
//         210,220,230,240,250,260,270,280,290,300,310,320,330,340,350),"Card");
        //$myDataRadar->addPoints(array_reverse(array(22.5,45,67.5,90,112.5,135,157.5,180,202.5,225,247.5,270,292.5,315,337.5,360)),"Card");
        $myDataRadar->addPoints($direcaoVento,"Card");
        $myDataRadar->setSerieDescription("Card",$this->descricaoSerie);
        $myDataRadar->setAbscissa("Card");
        
        
        //$myDataPolar->addPoints(array(20,40,60,80,100,120,140,160,180,200,220,240,260,280,300,320,340,360),"Coord");
        //$myDataPolar->addPoints(array(22.5,45,67.5,90,112.5,135,157.5,180,202.5,225,247.5,270,292.5,315,337.5,360),"Coord");
        //$myDataPolar->addPoints($arraySemDuplicacao,"Coord");
        $myDataPolar->addPoints($direcaoVento,"Coord");
        $myDataPolar->setSerieDescription("Coord",$this->descricaoSerie);
        $myDataPolar->setAbscissa("Coord");
        
        //calculando para SkipLabels (qntdade de intervalos nas labels do radar)
        $quantidade = count($arraySemDuplicacao);
        $skip = intval($quantidade / 5);
        
        $myPicture = new pImage(640,240, $myDataRadar, $this->transparencia);        
        
        /* Add a border to the picture */
        $myPicture->drawRectangle(0,0,0,0,array("R"=>0,"G"=>0,"B"=>0));

        $sdsd = array();
        $sdsd= array_unique(array(35,35,67,89,'x1',12,'x2'));
        array_multisort($sdsd,SORT_NATURAL);
        if($sdsd[1] == null) $e = 'afe';
        
        /* Write the picture title */
        $myPicture->setFontProperties(array("FontName"=>PORTALFONTS."verdana.ttf","FontSize"=>11));
        $myPicture->drawText(40,18,$this->tituloGrafico,array("R"=>0,"G"=>0,"B"=>0));
        //$myPicture->drawText($this->margemTituloEsq,$this->margemTituloSup,"".$this->tituloGrafico,array("FontSize"=>11,"Align"=>TEXT_ALIGN_BOTTOMLEFT)); //titulo grafico
        
        /* Set the default font properties */
        $myPicture->setFontProperties(array("FontName"=>PORTALFONTS."verdana.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80));
                
        /* Enable shadow computing */
        //$myPicture->setShadow(TRUE,array("X"=>2,"Y"=>2,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
        
        /* Create the pRadar object */
        $SplitChart = new pRadar();
        
        /* Draw a polar chart */
        $myPicture->setGraphArea(-50,25,340,235);
        $Options = array(                
            "SkipLabels"=>0,      
            "AxisRotation"=>0,
            "Layout"=>RADAR_LAYOUT_STAR,
            "LabelMiddle"=>FALSE,           
            "LabelsBackground"=>TRUE,
            "PointRadius"=>3,
            "LabelPadding"=>2,
            "TicksLength"=>1,
            "WriteLabels"=>TRUE,
            "LabelPos"=>RADAR_LABELS_ROTATED,
            "BackgroundGradient"=>array("StartR"=>255,"StartG"=>255,"StartB"=>255,"StartAlpha"=>100,"EndR"=>207,"EndG"=>227,"EndB"=>125,"EndAlpha"=>50)
        );        
        $SplitChart->drawRadar($myPicture,$myDataRadar,$Options);
        
        /* Draw a polar chart */
        $myPicture->setGraphArea(190,25,690,225);
        $Options = array(                     
            "LabelsBackground"=>TRUE,
            "PointRadius"=>2,
            "LabelPadding"=>4,
            "TicksLength"=>1,
            "AxisSteps"=>20,
            "WriteLabels"=>TRUE,
            "LabelPos"=>RADAR_LABELS_HORIZONTAL,
            "BackgroundGradient"=>array("StartR"=>255,"StartG"=>255,"StartB"=>255,"StartAlpha"=>50,"EndR"=>32,"EndG"=>109,"EndB"=>174,"EndAlpha"=>30),
            "AxisRotation"=>270,
            "DrawPoly"=>TRUE,
            "PolyAlpha"=>40
        );        
        $SplitChart->drawPolar($myPicture,$myDataPolar,$Options);

        /* Write the chart legend */
        //$myPicture->setFontProperties(array("FontName"=>"/var/www/portal/fonts/verdana.ttf","FontSize"=>9));
        //$myPicture->drawLegend(250,215,array("Style"=>LEGEND_ROUND,"Mode"=>LEGEND_HORIZONTAL));
        
        /* Render the picture (choose the best way) */       
        $myPicture->Render($this->pathGrafico);
    } 
    
}
