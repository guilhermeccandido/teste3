

<hr />


<h1>
<a href="http://localhost/porto/gchart_examples">Codeigniter gChart Examples</a>
 \ Basic Line Chart</h1> 
 <script type="text/javascript" src="https://www.google.com/jsapi"></script> 
 <script type="text/javascript"> 
 google.load('visualization', '1', {'packages':['timeline']}); 
 google.setOnLoadCallback(drawChart_stock_div); 
 function drawChart_stock_div() { 
	 var data = new google.visualization.DataTable();
			 
			    data.addColumn({ type: 'string', id: 'Term' });
			    data.addColumn({ type: 'string', id: 'Name' });
			    data.addColumn({ type: 'date', id: 'Start' });
			    data.addColumn({ type: 'date', id: 'End' });
			    data.addRows([
			      [ '1', 'George Washington', new Date(1789, 3, 30), new Date(1797, 2, 4) ],
			      [ '2', 'John Adams',        new Date(1797, 2, 4),  new Date(1801, 2, 4) ],
			      [ '3', 'Thomas Jefferson',  new Date(1801, 2, 4),  new Date(1809, 2, 4) ]]);


	  
		var options = {"title":"Stocks1"}; 
		var chart = new google.visualization.Timeline(document.getElementById('stock_div1')); 
		chart.draw(data, options); 
} 
 </script> 
 

<div id="stock_div1" style="width:800px;height:300px;" class=""></div> 
<hr /> <h2>Controller Code</h2> 



















