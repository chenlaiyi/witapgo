var PieOption = {
    a : { //支付方式比例图
		title : {
			text: '',
			x:'center'
		},
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} 笔 ({d}%)"
        },
        legend: {
            orient : 'vertical',
            x : 'left',
            data:['银联支付','支付宝支付','百付宝支付','微信支付','现金支付','余额支付']
        },
        calculable : true,
        series : [
            {
                name:' ',
                type:'pie',
                radius : '60%',
                center: ['50%', '60%'],
                data:[]
            }
        ]
    },
    b:{ // 交互功能使用率 初始化
        title : {
            text: '',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} 次 ({d}%)"
        },
        legend: {
            orient : 'vertical',
            x : 'left',
            data:['班级圈','在线报名','通知公告','打卡考勤','在线留言','相册','在线请假']
        },
        calculable : true,
        series : [
            {
                name:'交互功能使用率',
                type:'pie',
                radius : '60%',
                center: ['50%', '60%'],
                data:[]
            }
        ]
    },
    c:{
		tooltip : {
			trigger: 'item',
			formatter: function(c){if(c.series.typess==1){return c.name+"</br>"+c.value+"人";}else if(c.series.typess==2){return c.name+"</br>"+c.value+"%";}}
		},
		legend: {
			data:['出勤人数/次','出勤比例']
		},
		toolbox: {
			show : true,
			feature : {
				magicType : {show: true, type: ['line', 'bar']},
				restore : {show: true},
				saveAsImage : {show: true}
			}
		},
        calculable : false,
		grid: {y: 70, y2:30, x2:20,width:'80%'},
		xAxis : [
			{
				type : 'category',
				data : []
			},
			{
				type : 'category',
				axisLine: {show:false},
				axisTick: {show:false},
				axisLabel: {show:false},
				splitArea: {show:false},
				splitLine: {show:false},
				data : []
			}
		],
		yAxis: [{
			type: 'value',
			scale: true,
			name: '单位:人',
			min: 0,
			},{
			type: 'value',
			scale: true,
            min: 0,
			max: 100,
			name: '单位:%',
			}],
		series : [
			{
				name:'出勤人数/次',
				type:'bar',
				typess:1,

				itemStyle: {normal: {color:'rgba(65, 202, 192)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
			{
				name:'出勤比例',
				type:'bar',
				typess:2,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(119, 230,0)', label:{show:true,formatter:function(c){return c.value+"%";}}}},
				data:[]
			},
		]
    },
    d:{ //培训模式，柱状图
		tooltip : {
			trigger: 'item',
			formatter: function(c){if(c.series.typess==1){return c.series.name+"</br>"+c.value+"节";}else if(c.series.typess==6){return c.series.name+"</br>"+c.value+"元";}else{return c.series.name+"</br>"+c.value+"人次";}}
		},
		legend: {
			data:['课时安排/节','签到人次','请假人次','缺勤人次','新增报名人数','新增收入/元']
		},

        calculable : false,
		grid: {y: 70, y2:30, x2:20,width:'80%'},
		xAxis : [
			{
				type : 'category',
				data : []
			},
			{
				type : 'category',
				axisLine: {show:false},
				axisTick: {show:false},
				axisLabel: {show:false},
				splitArea: {show:false},
				splitLine: {show:false},
				data : []
			}
		],
		yAxis: [{
			type: 'value',
			scale: true,
			name: '单位:课时（人次）',
			min: 0,
			},{
			type: 'value',
			scale: true,
			name: '单位:元',
			}],
		series : [
			{
				name:'课时安排/节',
				type:'bar',
				typess:1,
				barWidth: 40,
				itemStyle: {normal: {color:'#529CD9', label:{show:true,formatter:function(c){return "课时安排:\n"+c.value+"节";}}}},
				data:[]
			},
			{
				name:'签到人次',
				type:'bar',
				typess:2,
				barWidth: 40,
				itemStyle: {normal: {color:'#5AC0E9', label:{show:true,formatter:function(c){return "签到:\n"+c.value+"人次";}}}},
				data:[]
			},
			{
				name:'请假人次',
				type:'bar',
				typess:3,
				barWidth: 40,
				itemStyle: {normal: {color:'#7AE0E6', label:{show:true,formatter:function(c){return "请假:\n"+c.value+"人次";}}}},
				data:[]
			},
			{
				name:'缺勤人次',
				type:'bar',
				typess:4,
				barWidth: 40,
				itemStyle: {normal: {color:'#9BF3DD', label:{show:true,formatter:function(c){return "缺勤:\n"+c.value+"人次";}}}},
				data:[]
			},
			{
				name:'新增报名人数',
				type:'bar',
				typess:5,
				barWidth: 40,
				itemStyle: {normal: {color:'#F9E05F', label:{show:true,formatter:function(c){return "新增报名:\n"+c.value+"人";}}}},
				data:[]
			},
		
			{
				name:'新增收入/元',
				type:'bar',
				typess:6,
				yAxisIndex: 1,
				barWidth: 40,
				itemStyle: {normal: {color:'#F7A081', label:{show:true,formatter:function(c){return "新增收入:\n"+c.value+"元";}}}},
				data:[]
			},
			
		]
	},
	mc:{
		tooltip : {
			trigger: 'item',
		},
		legend: {
			data:['正常','不正常','未检测']
		},
		toolbox: {
			show : false,
		},
        calculable : false,
		grid: {y: 70, y2:30, x2:20,width:'90%'},
		xAxis : [
			{
				type : 'category',
				data : []
			}
		],
		yAxis: [
			{
				type: 'value'
			}
		],
		series : [
			{
				name:'正常',
				type:'bar',
				typess:1,
				itemStyle: {normal: {color:'rgba(65, 202, 192,1)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
			{
				name:'不正常',
				type:'bar',
				typess:2,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 7, 7, 1)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
			{
				name:'未检测',
				type:'bar',
				typess:3,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(138, 138, 138, 1)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
		]
	},
	stumc:{
		tooltip : {
			trigger: 'item',
			formatter: function(c){if(c.series.typess==1){return c.name+"</br>"+c.value+"cm";}else if(c.series.typess==2){return c.name+"</br>"+c.value+'KG';}else if(c.series.typess==3){return c.name+"</br>"+c.value+'℃';}else if(c.series.typess==4){return c.name+"</br>"+c.value+'度';}}
		},
		legend: {
			data:['身高','体重','体温','左眼视力','右眼视力']
		},
		toolbox: {
			show : false,
		},
        calculable : false,
		grid: {y: 70, y2:30, x2:20,width:'80%'},
		xAxis : [
			{
				type : 'category',
				data : []
			}
		],
		yAxis: [
			{
				type: 'value'
			},
			{
				type: 'value'
			},
		],
		series : [
			{
				name:'身高',
				type:'line',
				typess:1,
				itemStyle: {normal: {color:'rgba(0, 128, 0,1)', label:{show:true,formatter:function(c){return c.value+"cm";}}}},
				data:[]
			},
			{
				name:'体重',
				type:'line',
				typess:2,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(1, 161, 255, 1)', label:{show:true,formatter:function(c){return c.value+"KG";}}}},
				data:[]
			},
			{
				name:'体温',
				type:'line',
				typess:3,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(146, 1, 255, 1)', label:{show:true,formatter:function(c){return c.value+"℃";}}}},
				data:[]
			},
			{
				name:'左眼视力',
				type:'line',
				typess:4,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 106, 0, 1)', label:{show:true,formatter:function(c){return c.value+"度";}}}},
				data:[]
			},
			{
				name:'右眼视力',
				type:'line',
				typess:4,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 24, 0, 1)', label:{show:true,formatter:function(c){return c.value+"度";}}}},
				data:[]
			},
		]
	},
	mobilestumc:{
		tooltip : {
			trigger: 'item',
			
		},
		legend: {
			y:'bottom',
			data:['身高','体重','体温','左眼视力','右眼视力']
		},
		toolbox: {
			show : false,
		},
        calculable : false,
		grid: {y: 70, y2:60, x2:20,width:'80%'},
		xAxis : [
			{
				type : 'category',
				data : [],
				axisLabel : {
					rotate : -30
				},
			},
		],
		yAxis: [
			{
				type: 'value',
				axisLabel :{
					rotate : -30
				},
			},
			{
				type: 'value',
				axisLabel :{
					rotate : -30
				},
			},
			

		],
		series : [
			{
				name:'身高',
				type:'line',
				typess:1,
				itemStyle: {normal: {color:'rgba(0, 128, 0,1)', label:{show:true,formatter:function(c){return c.value+"cm";}}}},
				data:[]
			},
			{
				name:'体重',
				type:'line',
				typess:2,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(1, 161, 255, 1)', label:{show:true,formatter:function(c){return c.value+"KG";}}}},
				data:[]
			},
			{
				name:'体温',
				type:'line',
				typess:3,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(146, 1, 255, 1)', label:{show:true,formatter:function(c){return c.value+"℃";}}}},
				data:[]
			},
			{
				name:'左眼视力',
				type:'line',
				typess:4,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 106, 0, 1)', label:{show:true,formatter:function(c){return c.value+"度";}}}},
				data:[]
			},
			{
				name:'右眼视力',
				type:'line',
				typess:4,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 24, 0, 1)', label:{show:true,formatter:function(c){return c.value+"度";}}}},
				data:[]
			},
		]
	},
	chartstumc:{
		tooltip : {
			trigger: 'item',
			formatter: function(c){if(c.series.typess==1){return c.name+"</br>"+c.value+"cm";}else if(c.series.typess==2){return c.name+"</br>"+c.value+'KG';}else if(c.series.typess==3){return c.name+"</br>"+c.value+'℃';}else if(c.series.typess==4){return c.name+"</br>"+c.value+'度';}}
		},
		legend: {
			y:'bottom',
			data:['身高','体重','体温','左眼','右眼']
		},
		toolbox: {
			show : false,
		},
        calculable : false,
		grid: {y: 60, x:25, x2:30,width:'80%'},
		xAxis : [
			{
				type : 'category',
				data : [],
				boundaryGap: false,
				splitLine:{ show:false },
				axisLabel : {
					rotate : -30
				},
			},
		],
		yAxis: [
			{
				type: 'value',
				inverse :'true',
				axisLabel :{
					rotate : -30
				},
				splitLine:{ show:false },
			},
			{
				type: 'value',
				inverse :'true',
				axisLabel :{
					rotate : -30
				},
				splitLine:{ show:false }, //去除网格线
			},

		],
		series : [
			{
				name:'身高',
				type:'line',
				typess:1,
				itemStyle: {normal: {color:'rgba(0, 128, 0,1)', label:{show:true,formatter:function(c){return c.value+"cm";}}}},
				data:[]
			},
			{
				name:'体重',
				type:'line',
				typess:2,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(1, 161, 255, 1)', label:{show:true,formatter:function(c){return c.value+"KG";}}}},
				data:[]
			},
			{
				name:'体温',
				type:'line',
				typess:3,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(146, 1, 255, 1)', label:{show:true,formatter:function(c){return c.value+"℃";}}}},
				data:[]
			},
			{
				name:'左眼',
				type:'line',
				typess:4,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 106, 0, 1)', label:{show:true,formatter:function(c){return c.value+"度";}}}},
				data:[]
			},
			{
				name:'右眼',
				type:'line',
				typess:4,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 24, 0, 1)', label:{show:true,formatter:function(c){return c.value+"度";}}}},
				data:[]
			},
		]
	},
	tiwennum:{
		tooltip: {
			trigger: 'axis'
		},
		legend: {
			y:'bottom',
			data:['体温']
		},
		xAxis: {
			type: 'category',
			boundaryGap: false,
			data: [],
		},
		grid: {y: 70, y2:60, x2:20,width:'80%'},
		yAxis: {
			type: 'value',

		},
		series: [{
			data: [],
			type: 'line',
			areaStyle: {
				color : "#1890ff"
			},
			//控制线条的颜色
			itemStyle : {
				normal : {
					borderColor : '#1890ff',
				}
			},
		   	lineStyle: {
				color : "#1890ff"
			},
			smooth: true
		}]
	},
	zzfb : { //柱状图表
		legend: {
			left: 80,
			top:50,
			textStyle: {  //标题文字大小
				fontSize: 18
			},
			data: []
		},
		series: [
			{
				type: 'pie',
				radius: '65%',
				center: ['50%', '50%'],
				data: [],
				label:false,
				itemStyle: {
					normal:{
						color:function(params) {
						var colorList = ['#9BF3DD','#F7A081','#4BFF9E'];
							return colorList[params.dataIndex]
						}
					}
			  	},
				emphasis: {
					itemStyle: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					}
				}
			}
		]
	},
	webzzfb : { //柱状图表
		animation: false,
		legend: {
			textStyle: {  //标题文字大小
				fontSize: 12
			},
			data: []
		},
		series: [
			{
				type: 'pie',
				radius: '65%',
				center: ['50%', '60%'],
				data: [],
				label:false,
				itemStyle: {
					normal:{
						color:function(params) {
						var colorList = ['#9BF3DD','#F7A081','#4BFF9E'];
							return colorList[params.dataIndex]
						}
					}
			  	},
				emphasis: {
					itemStyle: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					}
				}
			}
		]
	},
	copywebzzfb : { //柱状图表
		animation: false,
		legend: {
			textStyle: {  //标题文字大小
				fontSize: 48
			},
			data: []
		},
		series: [
			{
				type: 'pie',
				radius: '65%',
				center: ['50%', '60%'],
				data: [],
				label:false,
				itemStyle: {
					normal:{
						color:function(params) {
						var colorList = ['#9BF3DD','#F7A081','#4BFF9E'];
							return colorList[params.dataIndex]
						}
					}
			  	},
				emphasis: {
					itemStyle: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					}
				}
			}
		]
	},
	webchartstumc:{
		tooltip : {
			trigger: 'item',
			formatter: function(c){if(c.series.typess==1){return c.name+"</br>"+c.value+"cm";}else if(c.series.typess==2){return c.name+"</br>"+c.value+'KG';}else if(c.series.typess==3){return c.name+"</br>"+c.value+'℃';}else if(c.series.typess==4){return c.name+"</br>"+c.value+'度';}}
		},
		legend: {
			y:'bottom',
			data:['身高','体重','体温','左眼','右眼']
		},
		toolbox: {
			show : false,
		},
		grid: {y: 20, x:25, x2:30,width:'80%'},
		xAxis : [
			{
				type : 'category',
				data : [],
				boundaryGap: false,
				splitLine:{ show:false },
				axisLabel : {
					rotate : -30
				},
			},
		],
		yAxis: [
			{
				type: 'value',
				axisLabel :{
					rotate : -30
				},
				splitLine:{ show:false },
			},
			{
				type: 'value',
				axisLabel :{
					rotate : -30
				},
				splitLine:{ show:false }, //去除网格线
			},

		],
		series : [
			{
				name:'身高',
				type:'line',
				typess:1,
				itemStyle: {normal: {color:'rgba(0, 128, 0,1)', label:{show:true,formatter:function(c){return c.value+"cm";}}}},
				data:[]
			},
			{
				name:'体重',
				type:'line',
				typess:2,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(1, 161, 255, 1)', label:{show:true,formatter:function(c){return c.value+"KG";}}}},
				data:[]
			},
			{
				name:'体温',
				type:'line',
				typess:3,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(146, 1, 255, 1)', label:{show:true,formatter:function(c){return c.value+"℃";}}}},
				data:[]
			},
			{
				name:'左眼',
				type:'line',
				typess:4,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 106, 0, 1)', label:{show:true,formatter:function(c){return c.value+"度";}}}},
				data:[]
			},
			{
				name:'右眼',
				type:'line',
				typess:4,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 24, 0, 1)', label:{show:true,formatter:function(c){return c.value+"度";}}}},
				data:[]
			},
		]
	},
	webchartstumc_new:{
		animation:false,
		legend: {
			textStyle:{
                fontSize:8
            },
            itemWidth:12,
            itemHeight:8,
            bottom:2
		},
		toolbox: {
			show : false,
        },
        grid: {
                top:10, //图形距离顶部
                left: 10,
                right: 10,
                bottom: 12,
                containLabel: true //grid 区域是否包含坐标轴的刻度标签
            },
		xAxis : [
			{
				type : 'category',
				data : [],
                boundaryGap: false,
                axisLabel: {
                    interval:0,
                    rotate:35 ,
                    fontSize:8
                },
                axisTick:{
                    show:false
                },
				splitLine:{ show:false },
			},
		],
		yAxis: {
                type: 'value',
                offset:10,
                scale:true,
                axisTick:{
                    show:false
                },
                splitNumber:3,
                axisLabel: {
                    interval:5,
                    fontSize:8
                },
				splitLine:{ show:false },
			},
		series : []
	},
	copywebchartstumc:{
		tooltip : {
			trigger: 'item',
			formatter: function(c){if(c.series.typess==1){return c.name+"</br>"+c.value+"cm";}else if(c.series.typess==2){return c.name+"</br>"+c.value+'KG';}else if(c.series.typess==3){return c.name+"</br>"+c.value+'℃';}else if(c.series.typess==4){return c.name+"</br>"+c.value+'度';}}
		},
		legend: {
			textStyle: {  //标题文字大小
				fontSize: 48
			},
			y:'bottom',
			data:['身高','体重','体温','左眼','右眼']
		},
		toolbox: {
			show : false,
		},
		grid: {y: 20,y2:80, x:25, x2:30,width:'95%'},
		xAxis : [
			{
				type : 'category',
				data : [],
				boundaryGap: false,
				splitLine:{ show:false },
				axisLabel : {
					rotate : -30
				},
			},
		],
		yAxis: [
			{
				type: 'value',
				axisLabel :{
					rotate : -30
				},
				splitLine:{ show:false },
			},
			{
				type: 'value',
				axisLabel :{
					rotate : -30
				},
				splitLine:{ show:false }, //去除网格线
			},

		],
		series : [
			{
				name:'身高',
				type:'line',
				typess:1,
				itemStyle: {normal: {color:'rgba(0, 128, 0,1)', label:{show:true,formatter:function(c){return c.value+"cm";}}}},
				data:[]
			},
			{
				name:'体重',
				type:'line',
				typess:2,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(1, 161, 255, 1)', label:{show:true,formatter:function(c){return c.value+"KG";}}}},
				data:[]
			},
			{
				name:'体温',
				type:'line',
				typess:3,
				// yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(146, 1, 255, 1)', label:{show:true,formatter:function(c){return c.value+"℃";}}}},
				data:[]
			},
			{
				name:'左眼',
				type:'line',
				typess:4,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 106, 0, 1)', label:{show:true,formatter:function(c){return c.value+"度";}}}},
				data:[]
			},
			{
				name:'右眼',
				type:'line',
				typess:4,
				yAxisIndex: 1,
				itemStyle: {normal: {color:'rgba(255, 24, 0, 1)', label:{show:true,formatter:function(c){return c.value+"度";}}}},
				data:[]
			},
		]
	},
	tmc:{
		tooltip : {
			trigger: 'item',
		},
		toolbox: {
			show : false,
		},
        calculable : false,
		grid: {y: 10, y2:30, x:30, x2:-10,width:'86%'},
		xAxis : [
			{
				type : 'category',
				data : [],
				splitLine:{show:false},
				axisLabel :{
					rotate : -1
				},
			}
		],
		yAxis: [
			{
				type: 'value',
				splitLine:{show:false},
			}
		],
		series : [
			{
				name:'统计',
				type:'bar',
				typess:1,
				itemStyle: {normal: {color:'rgba(65, 202, 192,1)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
			
		]
	},
	eye:{
		tooltip : {
			trigger: 'item',
		},
		legend: {
			data:['左眼','右眼']
		},
		toolbox: {
			show : false,
		},
        calculable : false,
		grid: {y: 10, y2:30, x:30, x2:-10,width:'88%'},
		xAxis : [
			{
				type : 'category',
				data : [],
				splitLine:{show:false},
				axisLabel :{
					rotate : -1,
				},
				
			}
		],
		yAxis: [
			{
				type: 'value',
				splitLine:{show:false},
			}
		],
		series : [
			{
				name:'左眼',
				type:'bar',
				typess:1,
				itemStyle: {normal: {color:'rgba(65, 202, 192,1)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
			{
				name:'右眼',
				type:'bar',
				typess:2,
				itemStyle: {normal: {color:'rgba(138, 138, 138, 1)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
		]
	},
	tiwennormal:{
		tooltip: {
			trigger: 'axis'
		},
		legend: {
			data:['体温']
		},
		xAxis: {
			type: 'category',
			boundaryGap: false,
			axisLabel :{
				rotate : -30,
			},
			data: [],
		},
		
		yAxis: {
			type: 'value',
			splitLine:{show:false},
		},
		series: [{
			data: [],
			type: 'line',
			areaStyle: {
				color : "#1890ff"
			},
			//控制线条的颜色
			itemStyle : {
				normal : {
					borderColor : '#1890ff',
				}
			},
		   	lineStyle: {
				color : "#1890ff"
			},
			smooth: true
		}]
	},
	tiwennonormal:{
		tooltip: {
			trigger: 'axis'
		},
		xAxis: {
			type: 'category',
			boundaryGap: false,
			axisLabel :{
				rotate : -30,
			},
			data: [],
		},
		
		yAxis: {
			type: 'value',
			splitLine:{show:false},
		},
		series: [{
			data: [],
			type: 'line',
			areaStyle: {
				color : "#f98a69"
			},
			//控制线条的颜色
			itemStyle : {
				normal : {
					borderColor : '#f98a69',
				}
			},
		   	lineStyle: {
				color : "#f98a69"
			},
			smooth: true
		}]
	},
	mouth:{
		tooltip : {
			trigger: 'item',
		},
		legend: {
			data:['正常','异常','未检测']
		},
		toolbox: {
			show : false,
		},
        calculable : false,
		grid: {y: 70, y2:30, x2:20,width:'86%'},
		xAxis : [
			{
				type : 'category',
				data : [],
				axisLabel :{
					rotate : -90,
				},
			}
		],
		yAxis: [
			{
				type: 'value'
			}
		],
		series : [
			{
				name:'正常',
				type:'bar',
				typess:1,
				stack: '总数',
				itemStyle: {normal: {color:'rgba(65, 202, 192,1)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
			{
				name:'异常',
				type:'bar',
				typess:3,
				stack: '总数',
				itemStyle: {normal: {color:'rgba(183, 155, 15, 1)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
			{
				name:'未检测',
				type:'bar',
				typess:3,
				stack: '总数',
				itemStyle: {normal: {color:'rgba(138, 138, 138, 1)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
				data:[]
			},
		]
	},
}

var pieoption_c = {
	tooltip : {
		trigger: 'item',
		formatter: function(c){if(c.series.typess==1){return c.name+"</br>"+c.value+"人";}else if(c.series.typess==2){return c.name+"</br>"+c.value+"%";}}
	},
	legend: {
		data:['出勤人数/次','出勤比例']
	},
	toolbox: {
		show : true,
		feature : {
			magicType : {show: true, type: ['line', 'bar']},
			restore : {show: true},
			saveAsImage : {show: true}
		}
	},
	calculable : false,
	grid: {y: 70, y2:30, x2:20,width:'80%'},
	xAxis : [
		{
			type : 'category',
			data : []
		},
		{
			type : 'category',
			axisLine: {show:false},
			axisTick: {show:false},
			axisLabel: {show:false},
			splitArea: {show:false},
			splitLine: {show:false},
			data : []
		}
	],
	yAxis: [{
		type: 'value',
		scale: true,
		name: '单位:人',
		min: 0,
		},{
		type: 'value',
		scale: true,
		min: 0,
		max: 100,
		name: '单位:%',
		}],
	series : [
		{
			name:'出勤人数/次',
			type:'bar',
			typess:1,

			itemStyle: {normal: {color:'rgba(65, 202, 192)', label:{show:true,formatter:function(c){return c.value+"人";}}}},
			data:[]
		},
		{
			name:'出勤比例',
			type:'bar',
			typess:2,
			yAxisIndex: 1,
			itemStyle: {normal: {color:'rgba(119, 230,0)', label:{show:true,formatter:function(c){return c.value+"%";}}}},
			data:[]
		},
	]
};