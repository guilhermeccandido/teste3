// Fix map for IE
if (!('map' in Array.prototype)) { 
  Array.prototype.map = function (mapper, that /*opt*/) { 
    var other = new Array(this.length); 
    for (var i = 0, n = this.length; i < n; i++) 
      if (i in this) 
        other[i] = mapper.call(that, this[i], i, this); 
    return other; 
  }; 
};

var mapSVG = {
	states: ['TC', 'BA', 'SG', 'PE', 'AL', 'RN', 'CE', 'RS', 'FL', 'GA', 'HI', 'IA', 'ID', 'IL', 'IN', 'KS', 'KY', 'LA', 'MA', 'MD', 'ME', 'MI', 'MN', 'MO', 'MS', 'MT', 'NC', 'ND', 'NE', 'NH', 'NJ', 'NM', 'NV', 'NY', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VA', 'VT', 'WA', 'WI', 'WV', 'WY'],
	TC: "M289.558,235.641c16.104,0.575,44.973-31.647,44.835-45.259c-0.136-13.612-17.227-58.446-22.349-66.088c-5.122-7.628-37.905,2.506-37.905,2.506S234.852,233.695,289.558,235.641z",
	BA: "M313.276,197.775c2.084-2.739,3.506-7.012,6.464-8.764c1.641-0.973,3.232-4.684,4.271-5.163c2.304-1.014,12.161-25.143,20.706-22.513c1.095,0.342,29.881,3.478,32.153,7.532c2.246-0.506,17.582-8.804,25.829-4.999c9.172,4.246,11.225,20.679,11.2,20.843c0.107,0.328-0.823,5.765-0.985,5.929c-1.15,1-5.258-0.807-4.22,2.138c1.317,3.751,5.094,10.583,9.97,6.613c-3.669,6.574-6.846,16.022-13.966,17.747c-5.808,1.411-4.605,13.421-5.178,18.037c-0.465,3.75,0.192,8.448,1.014,12.117c1.148,4.959-0.821,8.6-1.808,13.42c-0.822,4.162-0.219,8.299-0.987,12.297c-0.271,1.286-4.407,5.723-5.559,7.148c-1.616-1.426-63.952-37.248-73.1-36.265c1.149-3.738,2.438-9.559-0.741-12.723c-8.625-8.572-0.135-19.335-0.162-19.432c-0.546-1.725-5.396-6.079-0.026-7.175c-3.175,0.959-1.944-4.027,0.875-3.012C316.726,200.733,314.044,200.527,313.276,197.775z",
	SG: "M408.561,191.735c0.521-1.505,2.465-0.725,3.533-0.794c2.273-0.164,0.494-2.738,1.095-3.778c2.026-3.793-2.738-5.999-1.998-10.408c4.024,1.931,9.448,3.397,12.408,6.89c1.343,1.533,5.504,2.656,5.832,4.847c-6.822,0.384-6.901,8.819-11.942,11.572C413.545,202.212,407.055,193.721,408.561,191.735z",
	PE: "M373.011,167.238c2.709-0.795,6.218-14.106,8.325-15.106c4.136-1.986,17.255-1.437,17.8,4.903c-0.437-0.068,8.189-2.273,7.479-1.466c1.7-0.711,10.518-4.723,12.599-4.82c0.274-0.013,4.603,0.905,3.068,2.315c-0.464,0.439,4.219,3.698,10.789,3.45c4.66-0.176,5.179-3.436,8.627-4.409c5.89-1.67,4.737,3.698,5.589,6.943c-1.182,2.684-1.646,5.586-2.74,8.285c-1.533,3.792-9.804,9.791-13.39,12.119c-7.287,4.778-21.802-4.067-22.762-5.67c-0.602-0.985-2.55-5.121-3.178-5.107c-0.629,0.356-1.04,0.861-1.287,1.519c-0.904-0.013-7.256-3.533-7.502-4.655c-4.769-1.151-5.425,6.108-8.957,6.19c0.219,0.108-8.244,6.681-7.506,3.314C383.556,170.4,374.241,168.566,373.011,167.238z",
	AL: "M413.953,169.018c3.78,3.313,9.424,5.505,12.547,5.491c3.229-0.013,5.009-3.328,7.421-4.794c1.177-0.712,10.297-1.93,9.174,1.042c-1.807,4.848-7.122,8.585-10.024,12.789c-2.792,2-3.423,7.093-6.354,1.864c-3.259,0.424-3.722-4.424-6.957-4.477c-3.668-2.261-7.998-3.769-11.201-6.342C410.615,172.646,412.751,171.359,413.953,169.018z",
	RN: "M404.698,138.795c2.383-4.027,6.574-6.123,8.49-11.149c1.973-5.107,3.834-5.818,8.764-4.642c5.041,1.207,9.339,0.837,14.57,1.671c7.534,1.193,6.848,10.968,9.206,16.516c-1.919,1.096-13.972,0.521-15.064-1.657c-1.041-2.067-2.904,7.107-5.094,7.3c1.532-5.847-12.654,1.78-5.424-8.683c2.545-3.67-6.302-0.808-6.711,0.725C410.121,144.013,407.217,139.151,404.698,138.795z",
	CE: "M372.379,104.409c0.437-1.368,2.961-3.627,1.043-5.025c12.106-1.328,17.581-0.849,27.66,6.723c4.026,3.054,6.822,5.574,10.571,9.147c1.317,1.273,7.614,4.313,7.914,6.164c-0.054-0.316-5.396,3.696-5.997,5.217c-1.066,2.684-2.659,6.093-4.3,8.298c0.025-0.055-6.903,3.957-3.532,4.217c-4.41,3.821-1.015,8.135-0.797,11.517c0.196,2.767-4.38,7.587-6.765,5.422c-2.244-1.999-3.998-5.711-7.779-5.094c-1.998,0.329-5.476,2.189-7.612,0.479c-2.52-2.054,3.669-5.162-0.545-7.354c-6.987-3.615-1.264-15.393-6.684-20.239c-3.504-3.136,1.753-7.313,0.109-10.749C374.952,111.68,373.694,105.244,372.379,104.409C373.035,102.314,374.815,105.971,372.379,104.409z",
	RS: "M191.236,416.881c0.52-2.684,7.38-8.409,9.477-10.351c0.37-0.359,8.599-10.08,9.174-8.329c-1.301-3.89,2.781-1.589,3.917-4.819c0.26-0.521,7.04-4.821,7.109-4.795c1.436-0.191,6.721-3.695,7.421-3.257c1.204-2.028,8.927-1.479,8.653-0.824c1.165-0.38,2.284-0.877,3.326-1.479c0.221-0.821,22.459,7.533,24.319,11.531c2.523,5.34,12.217,2.822,13.15,5.563c0.106,0.275-5.809,9.339-3.89,9.173c-0.985,0.08,3.204-2.875,3.834,0.409c-2.793,3.619-4.6,7.834-6.571,11.944c-3.696,7.614-8.872,12.765-15.886,17.42c-7.394,4.902-7.339,11.941-13.257,17.693c-8.091,7.942-10.159-0.574-4.08-5.752c3.806-3.231-22.527-19.746-25.578-22.732c-1.918-1.862-2.384,0.274-4.219,1.15c-2.547,1.205-1.917-2.822-3.588-4.273c-2.3-1.999-4.793-5.479-7.737-6.68c-3.478-1.367-5.615,5.145-9.052,0.821C189.168,418.854,190.332,418.032,191.236,416.881z",
}

var browser = BrowserDetect;

if (isOldBrowser()) {
	$('#old_browser_msg').show();
	$('#wtf').hide();
	$('fieldset#state').addClass('ff3');
	$('#ie8_percents').addClass('ff3');
	$('#share2').addClass('ff3');
	$('#poweredby.old_browsers').show();
}

var buckets = 11,
	colorScheme = 'rbow2',
	days = [
		{ name: 'Monday', abbr: 'Mo' },
		{ name: 'Tuesday', abbr: 'Tu' },
		{ name: 'Wednesday', abbr: 'We' },
		{ name: 'Thursday', abbr: 'Th' },
		{ name: 'Friday', abbr: 'Fr' },
		{ name: 'Saturday', abbr: 'Sa' },
		{ name: 'Sunday', abbr: 'Su' }
	],
	types = {
		all: 'All',
		pc: 'Computer',
		mob: 'Mobile'
	},
	hours = ['12a', '1a', '2a', '3a', '4a', '5a', '6a', '7a', '8a', '9a', '10a', '11a', '12p', '1p', '2p', '3p', '4p', '5p', '6p', '7p', '8p', '9p', '10p', '11p'],
	stateAbbrs = ['all', 'RS', 'AL', 'AR', 'AZ', 'CA', 'CO', 'CT', 'DC', 'DE', 'FL', 'GA', 'HI', 'IA', 'ID', 'IL', 'IN', 'KS', 'KY', 'LA', 'MA', 'MD', 'ME', 'MI', 'MN', 'MO', 'MS', 'MT', 'NC', 'ND', 'NE', 'NH', 'NJ', 'NM', 'NV', 'NY', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VA', 'VT', 'WA', 'WI', 'WV', 'WY'],
	states = {
		all: { name: 'All States', abbr: 'all', offset: 0 },
		RS: { name: 'Rio Grande do Sul', abbr: 'RS', offset: -1 },
		AL: { name: 'Alagoas', abbr: 'AL', offset: 2 },
		AR: { name: 'Arkansas', abbr: 'AR', offset: 2 },
		AZ: { name: 'Arizona', abbr: 'AZ', offset: 0 },
		CA: { name: 'California', abbr: 'CA', offset: 0 },
		CO: { name: 'Colorado', abbr: 'CO', offset: 1 },
		CT: { name: 'Connecticut', abbr: 'CT', offset: 3 },
		DC: { name: 'Washington D.C.', abbr: 'DC', offset: 3 },
		DE: { name: 'Delaware', abbr: 'DE', offset: 3 },
		FL: { name: 'Florida', abbr: 'FL', offset: 3 },
		GA: { name: 'Georgia', abbr: 'GA', offset: 3 },
		HI: { name: 'Hawaii', abbr: 'HI', offset: -3 },
		IA: { name: 'Iowa', abbr: 'IA', offset: 2 },
		ID: { name: 'Idaho', abbr: 'ID', offset: 1 },
		IL: { name: 'Illinois', abbr: 'IL', offset: 2 },
		IN: { name: 'Indiana', abbr: 'IN', offset: 3 },
		KS: { name: 'Kansas', abbr: 'KS', offset: 2 },
		KY: { name: 'Kentucky', abbr: 'KY', offset: 3 },
		LA: { name: 'Louisiana', abbr: 'LA', offset: 2 },
		MA: { name: 'Massachusetts', abbr: 'MA', offset: 3 },
		MD: { name: 'Maryland', abbr: 'MD', offset: 3 },
		ME: { name: 'Maine', abbr: 'ME', offset: 3 },
		MI: { name: 'Michigan', abbr: 'MI', offset: 3 },
		MN: { name: 'Minnesota', abbr: 'MN', offset: 2 },
		MO: { name: 'Missouri', abbr: 'MO', offset: 2 },
		MS: { name: 'Missippippi', abbr: 'MS', offset: 2 },
		MT: { name: 'Montana', abbr: 'MT', offset: 1 },
		NC: { name: 'North Carolina', abbr: 'NC', offset: 3 },
		ND: { name: 'North Dakota', abbr: 'ND', offset: 2 },
		NE: { name: 'Nebraska', abbr: 'NE', offset: 2 },
		NH: { name: 'New Hampshire', abbr: 'NH', offset: 3 },
		NJ: { name: 'New Jersey', abbr: 'NJ', offset: 3 },
		NM: { name: 'New Mexico', abbr: 'NM', offset: 1 },
		NV: { name: 'Nevada', abbr: 'NV', offset: 0 },
		NY: { name: 'New York', abbr: 'NY', offset: 3 },
		OH: { name: 'Ohio', abbr: 'OH', offset: 3 },
		OK: { name: 'Oklahoma', abbr: 'OK', offset: 2 },
		OR: { name: 'Oregon', abbr: 'OR', offset: 0 },
		PA: { name: 'Pennsylvania', abbr: 'PA', offset: 3 },
		RI: { name: 'Rhode Island', abbr: 'RI', offset: 3 },
		SC: { name: 'South Carolina', abbr: 'SC', offset: 3 },
		SD: { name: 'South Dakota', abbr: 'SD', offset: 2 },
		TN: { name: 'Tennessee', abbr: 'TN', offset: 2 },
		TX: { name: 'Texas', abbr: 'TX', offset: 2 },
		UT: { name: 'Utah', abbr: 'UT', offset: 1 },
		VA: { name: 'Virginia', abbr: 'VA', offset: 3 },
		VT: { name: 'Vermont', abbr: 'VT', offset: 3 },
		WA: { name: 'Washington', abbr: 'WA', offset: 0 },
		WI: { name: 'Wisconsin', abbr: 'WI', offset: 2 },
		WV: { name: 'West Virginia', abbr: 'WV', offset: 3 },
		WY: { name: 'Wyoming', abbr: 'WY', offset: 1 }
	};
	
var data;

if (isOldBrowser() === false) {
	//createMap();
}
addStateButtons();

d3.select('#vis').classed(colorScheme, true);

d3.json('tru247.json', function(json) {
	
	data = json;

	createTiles();
	reColorTiles('all', 'all');
	
	if (isOldBrowser() === false) {
		drawMobilePie('all');
	}
		
	/* ************************** */
	
	// State map click events
	d3.selectAll('#map path.state').on('click', function() {
		var $sel = d3.select('path.state.sel'),
			prevState, currState;
				
		if ($sel.empty()) {
			prevState = '';
		} else {
			prevState = $sel.attr('id');
		}
		
		currState = d3.select(this).attr('id');
		
		if (prevState !== currState) {
			var type = d3.select('#type label.sel span').attr('class');
			reColorTiles(currState, type);
			drawMobilePie(currState);
		}
		
		d3.selectAll('#map path.state').classed('sel', false);
		d3.select(this).classed('sel', true);
		d3.select('#show_all_states').classed('sel', false);
		d3.select('#wtf h2').html(states[currState].name);
		d3.select('fieldset#state label.sel').classed('sel', false);
		d3.select('fieldset#state label[for="state_' + currState + '"]').classed('sel', true);
	});
	
	/* ************************** */
	
	// All, PC, Mobile control event listener
	$('input[name="type"]').change(function() {
		
		var type = $(this).val(),
			$sel = d3.select('#map path.state.sel');
		
		d3.selectAll('fieldset#type label').classed('sel', false);
		d3.select('label[for="type_' + type + '"]').classed('sel', true);
		
		if ($sel.empty()) {
			var state = 'all';
		} else {
			var state = $sel.attr('id');
		}
		
		reColorTiles(state, type);
		d3.select('#pc2mob').attr('class', type);
		
		var type = types[selectedType()];
		d3.select('#wtf .subtitle').html(type  + ' traffic daily');
	});
	
	/* ************************** */
	
	// All States click
	$('label[for="state_all"]').click(function() {
		
		d3.selectAll('fieldset#state label').classed('sel', false);
		$(this).addClass('sel');
		var type = d3.select('input[name="type"]').property('value');
		
		d3.selectAll('#map path.state').classed('sel', false);
		
		reColorTiles('all', type);
		drawMobilePie('all');
		
		d3.select('#wtf h2').html('All States');
	});
	
	/* ************************** */
	
	// Text States list event listener
	$('input[name="state"]').change(function() {
		
		var state = $(this).val(),
			type = d3.select('input[name="type"]').property('value');
		
		d3.selectAll('fieldset#state label').classed('sel', false);
		d3.select('label[for="state_' + state + '"]').classed('sel', true);
		
		reColorTiles(state, type);
		updateIE8percents(state);
	});

	/* ************************** */
	
	// tiles mouseover events
	$('#tiles td').hover(function() {
	
		$(this).addClass('sel');
		
		var tmp = $(this).attr('id').split('d').join('').split('h'),
			day = parseInt(tmp[0]),
			hour = parseInt(tmp[1]);
		
		var $sel = d3.select('#map path.state.sel');
		
		if ($sel.empty()) {
			var state = 'all';
		} else {
			var state = $sel.attr('id');
		}
		
		var view = 'all';
		
		if (isOldBrowser() === false) {
			drawHourlyChart(state, day);
			selectHourlyChartBar(hour);
		}
		
		var type = types[selectedType()];
		d3.select('#wtf .subtitle').html(type  + ' traffic on ' + days[day].name + 's');
	
	}, function() {
		
		$(this).removeClass('sel');
		
		var $sel = d3.select('#map path.state.sel');
		
		if ($sel.empty()) {
			var state = 'all';
		} else {
			var state = $sel.attr('id');
		}
		if (isOldBrowser() === false) {
			drawHourlyChart(state, 3);
		}
		var type = types[selectedType()];
		d3.select('#wtf .subtitle').html(type  + ' traffic daily');
	});
});

/* ************************** */

function isOldBrowser() {

	var result = false;
	if (browser.browser === 'Explorer' && browser.version < 9) {
		result = true;
	} else if (browser.browser === 'Firefox' && browser.version < 4) {
		result = true;
	}
	
	//console.log(result);
	
	return result;
}


/* ************************** */

function selectedType() {
	
	//return d3.select('input[name="type"]:checked').property('value'); // IE8 doesn't like this
	return $('input[name="type"]:checked').val();
}

/* ************************** */

function addStateButtons() {

	for (var i = 1; i < stateAbbrs.length; i++) {
		var abbr = stateAbbrs[i];
		var html = '<input type="radio" id="state_' + abbr + '" name="state" value="' + abbr + '"/><label for="state_' + abbr + '"><span class="' + abbr + '">' + abbr + '</span></label>';
	
		$('fieldset#state').append(html);
	}
}

/* ************************** */

function getCalcs(state, view) {
	
	var min = 1,
		max = -1;
	
	// calculate min + max
	for (var d = 0; d < data[state].views.length; d++) {
		for (var h = 0; h < data[state].views[d].length; h++) {
			
			if (view === 'all') {
				var tot = data[state].views[d][h].pc + data[state].views[d][h].mob;
			} else {
				var tot = data[state].views[d][h][view];
			}
			
			if (tot > max) {
				max = tot;
			}
			
			if (tot < min) {
				min = tot;
			}
		}
	}
	
	return {'min': min, 'max': max};
};

/* ************************** */

function reColorTiles(state, view) {
	
	var calcs = getCalcs(state, view),
		range = [];
	
	for (var i = 1; i <= buckets; i++) {
		range.push(i);
	}
	
	var bucket = d3.scale.quantize().domain([0, calcs.max > 0 ? calcs.max : 1]).range(range),
		side = d3.select('#tiles').attr('class');
	
	
	if (side === 'front') {
		side = 'back';
	} else {
		side = 'front';
	}
	
	for (var d = 0; d < data[state].views.length; d++) {
		for (var h = 0; h < data[state].views[d].length; h++) {

			var sel = '#d' + d + 'h' + h + ' .tile .' + side,
				val = data[state].views[d][h].pc + data[state].views[d][h].mob;
			
			if (view !== 'all') {
				val = data[state].views[d][h][view];
			}
			
			// erase all previous bucket designations on this cell
			for (var i = 1; i <= buckets; i++) {
				var cls = 'q' + i + '-' + buckets;
				d3.select(sel).classed(cls , false);
			}
			
			// set new bucket designation for this cell
			var cls = 'q' + (val > 0 ? bucket(val) : 0) + '-' + buckets;
			d3.select(sel).classed(cls, true);
		}
	}
	flipTiles();
	if (isOldBrowser() === false) {
		drawHourlyChart(state, 3);
	}
}

/* ************************** */

function flipTiles() {

	var oldSide = d3.select('#tiles').attr('class'),
		newSide = '';
	
	if (oldSide == 'front') {
		newSide = 'back';
	} else {
		newSide = 'front';
	}
	
	var flipper = function(h, d, side) {
		return function() {
			var sel = '#d' + d + 'h' + h + ' .tile',
				rotateY = 'rotateY(180deg)';
			
			if (side === 'back') {
				rotateY = 'rotateY(0deg)';	
			}
			if (browser.browser === 'Safari' || browser.browser === 'Chrome') {
				d3.select(sel).style('-webkit-transform', rotateY);
			} else {
				d3.select(sel).select('.' + oldSide).classed('hidden', true);
				d3.select(sel).select('.' + newSide).classed('hidden', false);
			}
				
		};
	};
	
	for (var h = 0; h < hours.length; h++) {
		for (var d = 0; d < days.length; d++) {
			var side = d3.select('#tiles').attr('class');
			setTimeout(flipper(h, d, side), (h * 20) + (d * 20) + (Math.random() * 100));
		}
	}
	d3.select('#tiles').attr('class', newSide);
}

/* ************************** */

function drawHourlyChart(state, day) {
	
	d3.selectAll('#hourly_values svg').remove();
	
	var w = 300,
		h = 150;
	
	var weeklyData = data[state].views[day],
		view = d3.select('#type label.sel span').attr('class');
		
		
	var y = d3.scale.linear()
		.domain([0, d3.max(weeklyData, function(d) { return (view === 'all') ? d.pc + d.mob : d[view] })])
		.range([0, h]);

	
	var chart = d3.select('#hourly_values .svg')
		.append('svg:svg')
		.attr('class', 'chart')
		.attr('width', 300)
		.attr('height', 170);
		
	var rect = chart.selectAll('rect'),
		text = chart.selectAll('text');
	
	rect.data(weeklyData)
		.enter()
			.append('svg:rect')
				.attr('x', function(d, i) { return i * 12; })
				.attr('y', function(d) { return (view === 'all') ? h - y(d.pc + d.mob) : h - y(d[view]) })
				.attr('height', function(d) { return (view === 'all') ? y(d.pc + d.mob) : y(d[view]) })
				.attr('width', 10)
				.attr('class', function(d, i) { return 'hr' + i});
	
	text.data(hours)
		.enter()
			.append('svg:text')
				.attr('class', function(d, i) { return (i % 3) ? 'hidden hr' + i : 'visible hr' + i })
				.attr("x", function(d, i) { return i * 12 })
				.attr("y", 166)
				.attr("text-anchor", 'left')
				.text(String);
}

/* ************************** */

function drawMobilePie(state) {

	var w = 150,
		h = 150,
		r = Math.min(w, h) / 2,
		pieData = [1, data[state].pc2mob],
		pie = d3.layout.pie(),
		arc = d3.svg.arc().innerRadius(0).outerRadius(r),
		type = selectedType();
	
	d3.select('#pc2mob').attr('class', type);
	d3.selectAll('#pc2mob svg').remove();
	
	var chart = d3.select("#pc2mob .svg").append('svg:svg')
		.data([pieData])
		.attr("width", w)
		.attr("height", h);
	
	var arcs = chart.selectAll('g')
		.data(pie)
		.enter().append('svg:g')
			.attr("transform", "translate(" + r + "," + r + ")");
	
	arcs.append('svg:path')
		.attr('d', arc)
		.attr('class', function(d, i) { return i === 0 ? 'mob' : 'pc' });
	
	var rawMobPercent = 100 / (data[state].pc2mob + 1);
	
	if (rawMobPercent < 1) {
		var mobPercent = '< 1',
			pcPercent = '> 99';
	} else {
		var mobPercent = Math.round(rawMobPercent),
			pcPercent = 100 - mobPercent;
	}
	
	d3.select('#pc2mob .pc span').html(pcPercent + '%');
	d3.select('#pc2mob .mob span').html(mobPercent + '%');
	
	var html = d3.select('#pc2mob ul').html();
	d3.select('#ie8_percents').html(html);
}

/* ************************** */

function updateIE8percents(state) {

	var rawMobPercent = 100 / (data[state].pc2mob + 1);
	
	if (rawMobPercent < 1) {
		var mobPercent = '< 1',
			pcPercent = '> 99';
	} else {
		var mobPercent = Math.round(rawMobPercent),
			pcPercent = 100 - mobPercent;
	}
	
	d3.select('#pc2mob .pc span').html(pcPercent + '%');
	d3.select('#pc2mob .mob span').html(mobPercent + '%');
	
	var html = d3.select('#pc2mob ul').html();
	d3.select('#ie8_percents').html(html);
}




/* ************************** */

function createTiles() {

	var html = '<table id="tiles" class="front">';

	html += '<tr><th><div>&nbsp;</div></th>';

	for (var h = 0; h < hours.length; h++) {
		html += '<th class="h' + h + '">' + hours[h] + '</th>';
	}
	
	html += '</tr>';

	for (var d = 0; d < days.length; d++) {
		html += '<tr class="d' + d + '">';
		html += '<th>' + days[d].abbr + '</th>';
		for (var h = 0; h < hours.length; h++) {
			html += '<td id="d' + d + 'h' + h + '" class="d' + d + ' h' + h + '"><div class="tile"><div class="face front"></div><div class="face back"></div></div></td>';
		}
		html += '</tr>';
	}
	
	html += '</table>';
	d3.select('#vis').html(html);
}

/* ************************** */

function selectHourlyChartBar(hour) {

	d3.selectAll('#hourly_values .chart rect').classed('sel', false);
	d3.selectAll('#hourly_values .chart rect.hr' + hour).classed('sel', true);
	
	d3.selectAll('#hourly_values .chart text').classed('hidden', true);
	d3.selectAll('#hourly_values .chart text.hr' + hour).classed('hidden', false);

};

/* ************************** */

function createMap() {
	var svg = d3.select("#map").append('svg:svg')
		.attr('width', 620)
		.attr('height', 800);
	
	var g = svg.append('svg:g')
		.attr('transform', 'scale(1) translate(-27, 1)');
	
	for (s = 0; s < mapSVG.states.length; s++ ) {
		var state = mapSVG.states[s];
		
		var path = g.append('svg:path')
			.attr('id', state)
			.attr('class', 'state')
			.attr('stroke', '#FFFFFF')
			.attr('stroke-width', '1.0404')
			.attr('stroke-linecap', 'round')
			.attr('d', mapSVG[state]);
	}	
}