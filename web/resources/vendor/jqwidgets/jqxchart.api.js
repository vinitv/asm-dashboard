/*
jQWidgets v4.5.0 (2017-Jan)
Copyright (c) 2011-2017 jQWidgets.
License: http://jqwidgets.com/license/
*/
!function(a){a.extend(a.jqx._jqxChart.prototype,{_moduleApi:!0,getItemsCount:function(a,b){var c=this.seriesGroups[a];if(!this._isSerieVisible(a,b))return 0;var d=this._renderData;if(!c||!d||d.length<=a)return 0;var e=c.series[b];return e?d[a].offsets[b].length:0},getXAxisRect:function(a){var b=this._renderData;if(b&&!(b.length<=a)&&b[a].xAxis)return b[a].xAxis.rect},getXAxisLabels:function(a){var b=[],c=this._renderData;if(!c||c.length<=a)return b;if(c=c[a].xAxis,!c)return b;var d=this.seriesGroups[a];if(d.polar||d.spider){for(var e=0;e<c.polarLabels.length;e++){var f=c.polarLabels[e];b.push({offset:{x:f.x,y:f.y},value:f.value})}return b}for(var g=this._getXAxis(a),h=this.getXAxisRect(a),i="top"==g.position||"right"==g.position,j="horizontal"==d.orientation,e=0;e<c.data.length;e++)j?b.push({offset:{x:h.x+(i?0:h.width),y:h.y+c.data.data[e]},value:c.data.xvalues[e]}):b.push({offset:{x:h.x+c.data.data[e],y:h.y+(i?h.height:0)},value:c.data.xvalues[e]});return b},getValueAxisRect:function(a){var b=this._renderData;if(b&&!(b.length<=a)&&b[a].valueAxis)return b[a].valueAxis.rect},getValueAxisLabels:function(a){var b=[],c=this._renderData;if(!c||c.length<=a)return b;if(c=c[a].valueAxis,!c)return b;var d=this._getValueAxis(a),e="top"==d.position||"right"==d.position,f=this.seriesGroups[a],g="horizontal"==f.orientation;if(f.polar||f.spider){for(var h=0;h<c.polarLabels.length;h++){var i=c.polarLabels[h];b.push({offset:{x:i.x,y:i.y},value:i.value})}return b}for(var h=0;h<c.items.length;h++)g?b.push({offset:{x:c.itemOffsets[c.items[h]].x+c.itemWidth/2,y:c.rect.y+(e?c.rect.height:0)},value:c.items[h]}):b.push({offset:{x:c.rect.x+c.rect.width,y:c.itemOffsets[c.items[h]].y+c.itemWidth/2},value:c.items[h]});return b},getPlotAreaRect:function(){return this._plotRect},getRect:function(){return this._rect},showToolTip:function(a,b,c,d,e){var f=this.getItemCoord(a,b,c);isNaN(f.x)||isNaN(f.y)||this._startTooltipTimer(a,b,c,f.x,f.y,d,e)},hideToolTip:function(a){isNaN(a)&&(a=0);var b=this;b._cancelTooltipTimer(),setTimeout(function(){b._hideToolTip(0)},a)}})}(jqxBaseFramework);

