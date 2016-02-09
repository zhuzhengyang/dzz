(function(){

    var editor = null;

    UM.registerWidget('emotion',{
		
		getTpl:function(){
			var tpl="<link type=\"text/css\" rel=\"stylesheet\" href=\"<%=emotion_url%>emotion.css\">" +
				"<div id=\"edui-emotion-tab-Jpanel\" class=\"edui-emotion-wrapper\">" +
				"<ul id=\"edui-emotion-Jtabnav\" class=\"edui-tab-nav\">";
				
				for(var i in smilies_type){
					tpl+="<li class=\"edui-tab-item\"><a href=\"#edui-emotion-Jtab"+i+"\" hideFocus=\"true\" class=\"edui-tab-text\">"+smilies_type[i][0]+"</a></li>" ;
				}
				tpl+="<li class=\"edui-emotion-tabs\"></li>";
				tpl+="</ul>" +
				"<div id=\"edui-emotion-JtabBodys\" class=\"edui-tab-content\">";
				for(var i in smilies_type){
				  tpl+="<div id=\"edui-emotion-Jtab"+i+"\" class=\"edui-tab-pane\"></div>" ;
				}
				
				tpl+="</div>" +
				"<div id=\"edui-emotion-JtabIconReview\" class=\"edui-emotion-preview-box\">" +
				"<img id=\'edui-emotion-JfaceReview\' src=\"<%=cover_img%>\" class=\'edui-emotion-preview-img\'/>" +
				"</div>";
				return tpl;
		},
		 getSourceData:function(){
			 var emotion={};
			 emotion.tabNum=0;
			 for(var i in smilies_type){
				 emotion.tabNum+=1;
			}
			emotion.smilies_array=smilies_array;
			emotion.imageFolders={};
			for(var i in smilies_type){
				 emotion.imageFolders['edui-emotion-Jtab'+i]=smilies_type[i][1];
			}
			return emotion;
		 },
       
        initContent:function( _editor, $widget ){

            var me = this;
            if( me.inited ) {
                me.preventDefault();
                this.switchToFirst();
                return;
            } emotionUrl = UMEDITOR_CONFIG.UMEDITOR_HOME_URL + 'dialogs/emotion/';
                options = jQuery.extend( {}, null, {
                    emotion_url: emotionUrl
                } );
			me.emotion = me.getSourceData();
            me.inited = true;

            editor = _editor;
            this.widget = $widget;
			//s = smilies_array[type][page][i];
			//smilieimg = STATICURL + 'image/smiley/' + smilies_type['_' + type][1] + '/' + s[2];
            me.emotion.SmileyPath =SITEURL+STATICURL + 'image/smiley/';
            me.emotion.SmileyBox = me.createTabList( me.emotion.tabNum );
            me.emotion.tabExist = me.createArr( me.emotion.tabNum );

            options['cover_img'] = SITEURL+'dzz/images/b.gif';

            me.root().html( jQuery.parseTmpl( me.getTpl(), options ) );

            me.tabs = jQuery.eduitab({selector:"#edui-emotion-tab-Jpanel"});
            //缓存预览对象
            me.previewBox = jQuery("#edui-emotion-JtabIconReview");
            me.previewImg = jQuery("#edui-emotion-JfaceReview");

            me.initImgName();

        },
        initEvent:function(){

            var me = this;

            //防止点击过后关闭popup
            me.root().on('click', function(e){
                return false;
            });

            //移动预览
            me.root().delegate( 'td', 'mouseover mouseout', function( evt ){

                var $td = jQuery( this),
                    url = $td.attr('data-surl') || null;

                if( url ) {
                    me[evt.type]( this, url , $td.attr('data-posflag') );
                }

                return false;

            } );

            //点击选中
            me.root().delegate( 'td', 'click', function( evt ){

                var $td = jQuery( this),
                    realUrl = $td.attr('data-realurl') || null;

                if( realUrl ) {
                    me.insertSmiley( realUrl.replace( /'/g, "\\'" ), evt );
                }

                return false;

            } );

            //更新模板
            me.tabs.edui().on("beforeshow", function( evt ){

                var contentId = evt.target.href.replace( /^.*#(?=[^\s]*$)/, '' );
                evt.stopPropagation();
                me.updateTab( contentId );
            });

            this.switchToFirst();

        },
        initImgName: function() {
			var me=this;
            var emotion = me.emotion;

            for ( var pro in emotion.SmilmgName ) {
                var tempName = emotion.SmilmgName[pro],
                    tempBox = emotion.SmileyBox[pro],
                    tempStr = "";

                if ( tempBox.length ) return;

                for ( var i = 1; i <= tempName[1]; i++ ) {
                    tempStr = tempName[0];
                    if ( i < 10 ) tempStr = tempStr + '0';
                    tempStr = tempStr + i + '.gif';
                    tempBox.push( tempStr );
                }
            }

        },
        /**
         * 切换到第一个tab
         */
        switchToFirst: function(){
            jQuery("#edui-emotion-Jtabnav .edui-tab-text:first").trigger('click');
        },
        updateTab: function( contentBoxId ) {
          var me = this;
		  var i=parseInt(contentBoxId.replace('edui-emotion-Jtab_',''))-1;
		  console.log(me.emotion.tabExist);
            if (!me.emotion.tabExist[ i ] ) {
                me.emotion.tabExist[ i ] = true;
                me.createTab( contentBoxId );
            }
        },
        createTabList: function( tabNum ) {
            var obj = {};
            for ( var i = 1; i <= tabNum; i++ ) {
				var list=[];
				for(var j =1 ;j<smilies_array[i].length;j++){
					var len=smilies_array[i][j].length;
					for(var k=0;k<len;k++){
						list.push(smilies_array[i][j][k]);
					}
				}
                obj["edui-emotion-Jtab_" + i] = list;
            }
            return obj;
        },
        mouseover: function( td, srcPath, posFlag ) {

            posFlag -= 0;

            jQuery(td).css( 'backgroundColor', '#F7F7F7' ).css('border','1px solid #CCC');

            this.previewImg.css( "backgroundImage", "url(" + srcPath + ")" );
            if(posFlag){
				this.previewBox.css({left:15})
				this.previewBox.addClass('edui-emotion-preview-left');
			}else{
				this.previewBox.css({left:jQuery(td).parent().width()-35});
			}
            this.previewBox.show();

        },
        mouseout: function( td ) {
            jQuery(td).css( 'backgroundColor', 'transparent' ).css('border','1px solid #FFF');
            this.previewBox.removeClass('edui-emotion-preview-left').hide();
        },
        insertSmiley: function( url, evt ) {
            var obj = {
                src: url
            };
            obj._src = obj.src;
            editor.execCommand( 'insertimage', obj );
            if ( !evt.ctrlKey ) {
                //关闭预览
                this.previewBox.removeClass('edui-emotion-preview-left').hide();
                this.widget.edui().hide();
            }
        },
        createTab: function( contentBoxId) {
			
            var faceVersion = "?v=1.1", //版本号
                me = this,
                $contentBox = jQuery("#"+contentBoxId),
                emotion = me.emotion,
                imagePath = emotion.SmileyPath + emotion.imageFolders[contentBoxId]+'/', //获取显示表情和预览表情的路径
                positionLine = 11 / 2, //中间数
                iWidth = iHeight = 24, //图片长宽
				iWidth=parseInt(emotion.SmileyBox[ contentBoxId ][0][3]) || 24,
				iHeight=parseInt(emotion.SmileyBox[ contentBoxId ][0][4])|| 24,
                iColWidth = 3, //表格剩余空间的显示比例
                tableCss ='td',
                cssOffset = 0,
                textHTML = ['<table border="0" class="edui-emotion-smileytable">'],
                i = 0, imgNum = emotion.SmileyBox[ contentBoxId ].length, imgColNum = 11, faceImage,
                sUrl, realUrl, posflag, offset, infor;
			
				
            for ( ; i < imgNum; ) {
                textHTML.push( '<tr>' );
                for ( var j = 0; j < imgColNum; j++, i++ ) {
                    faceImage = emotion.SmileyBox[ contentBoxId ][i];
                    if ( faceImage ) {
                        sUrl = imagePath + faceImage[2];
                        realUrl = imagePath + faceImage[2];
                        posflag = j < positionLine ? 0 : 1;
                        offset = cssOffset * i * (-1) - 1;
                        var title = faceImage[6];
						
                        textHTML.push( '<td  class="edui-emotion-' + tableCss + '" data-surl="'+ sUrl +'" data-realurl="'+ realUrl +'" data-posflag="'+ posflag +'" align="center">' );
                       // textHTML.push( '<span>' );
                        textHTML.push( '<img  style="background-position:left ' + offset + 'px;" title="' + title + '" src="' + sUrl+'" width="' + iWidth + '" height="' + iHeight + '"></img>' );
                       // textHTML.push( '</span>' );
                    } else {
                        textHTML.push( '<td bgcolor="#FFFFFF">' );
                    }
                    textHTML.push( '</td>' );
                }
                textHTML.push( '</tr>' );
				
            }
            textHTML.push( '</table>' );
            textHTML = textHTML.join( "" );
            $contentBox.html( textHTML );
			$contentBox.css({width:imgColNum*(1*iWidth+5)});
        },
        createArr: function( tabNum ) {
            var arr = [];
            for ( var i = 0; i < tabNum; i++ ) {
                arr[i] = 0;
            }
            return arr;
        },
        
    });

})();

