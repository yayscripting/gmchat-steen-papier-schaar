var mainInterval;
var mySelect = null;
var waitForStart = false;

window.addEvent('domready', function() {
	mainInterval = getVars.periodical(3000);
	
	$$('.choose div img').addEvent('click',function(){
		mySelect = this.id;
		$$('.wait img').each(function(el){ el.src = 'images/'+mySelect+'.png'; });
		
		var send = new Request({url: 'set.php?session='+session}).send('choose='+this.id+'&playerid='+playerid);
		
		$$('.info').set('html', 'Even wachten..');
		$$('.choose').setStyle('display','none');
		$$('.wait').setStyle('display','block');
		
	});
	
});

getVars = function(){
	var sended = new Request.JSON({url: 'variables.php?session='+session, onComplete: processVars}).send();
}

processVars = function(result){

	if(result.action == 'result'){
		$('p1guess').src = 'images/'+((result.win == 1) ? 'win_' : 'lost_')+ result.p1guess+'.png';
		$('p2guess').src = 'images/'+((result.win == 2) ? 'win_' : 'lost_')+ result.p2guess+'.png';
		
		$$('.info').set('html', ((result.win == playerid) ? 'Je hebt gewonnen!' : ((result.win != 0) ? 'Je hebt verloren!' : 'Gelijkspel!')));
		$$('.wait').setStyle('display','none');
		$$('.showdown').setStyle('display','block');
			
		waitForStart = true;
	}else
	if(result.action == 'start' && waitForStart == true){

			mySelect = null;
			$$('.info').set('html', 'Maak je keuze!');
			$$('.choose').setStyle('display','block');
			$$('.showdown').setStyle('display','none');
	
		
		waitForStart = false;
	}
	
	$('score_1').set('html', result.score['1']);
	$('score_2').set('html', result.score['2']);
}