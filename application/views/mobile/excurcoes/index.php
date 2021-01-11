    <div class="container top" style="width: 800px;">
	<div id="carousel" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carousel" data-slide-to="0" class="active"></li>
	    <li data-target="#carousel" data-slide-to="1"></li>
	    <li data-target="#carousel" data-slide-to="2"></li>
	  </ol>
	  <!-- Carousel items -->
	  <div class="carousel-inner" role="listbox">
	    <div class="active item">
            <img src="assets/img/portal/bootstrap-mdo-sfmoma-01.jpg" alt="">
            <div class="carousel-caption">
                <h4>First Thumbnail label</h4>
            	<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        	</div>
        </div>
        <div class="item">
            <img src="assets/img/portal/bootstrap-mdo-sfmoma-02.jpg" alt="">
            <div class="carousel-caption">
                <h4>First Thumbnail label</h4>
            	<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        	</div>
        </div>
        <div class="item">
            <img src="assets/img/portal/bootstrap-mdo-sfmoma-03.jpg" alt="">
            <div class="carousel-caption">
                <h4>First Thumbnail label</h4>
            	<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        	</div>
        </div>
	  </div>
	  <!-- Carousel nav -->
	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>    
    </div>
    
<script>    
	$('.carousel').carousel({
	  interval: 5000
	})
</script>