function phpBBGoogleWave() {}

phpBBGoogleWave.prototype.setup = function(bgcolour,colour,font,fontsize) {
    this.waves = [];
    this.wavePanels = [];
    this.bgcolour = bgcolour;
    this.colour = colour;
    this.font = font;
    this.fontsize = fontsize;
};

phpBBGoogleWave.prototype.randomDivId = function() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 16;
	var divId = 'google_wave_bbcode_embed_';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		divId += chars.substring(rnum,rnum+1);
	}
	return divId;
};

phpBBGoogleWave.prototype.addWave = function(waveId) {
        var div = this.randomDivId();
        tempWaveId = waveId.split("wave:");
        if(tempWaveId[1]) {
            realWaveId = tempWaveId[1].replace("%252B","+");
        } else {
            realWaveId = waveId;
        }
	phpBBGoogleWave.waves.push({div: div, waveId: realWaveId});
        return div;
};

phpBBGoogleWave.prototype.applyWaves = function() {
        for( var i in phpBBGoogleWave.waves ) {
            if(phpBBGoogleWave.waves[i].div){
                var div = phpBBGoogleWave.waves[i].div;
                var waveId = phpBBGoogleWave.waves[i].waveId;
                phpBBGoogleWave.wavePanels[div] = new WavePanel('https://wave.google.com/wave/');
                phpBBGoogleWave.wavePanels[div].setUIConfig(this.bgcolour,this.colour,this.font,this.fontsize);
                phpBBGoogleWave.wavePanels[div].loadWave(waveId);
                phpBBGoogleWave.wavePanels[div].init(document.getElementById(div));
            }
        }
};