var CALENDAR=function(){function e(e,r,l){var i,d=a.text().trim().split(" "),o=parseInt(d[1],10);o=parseInt($("#year").text(),10),r=r||(e?"DEC"===d[0]?0:c.indexOf(d[0])+1:"JAN"===d[0]?11:c.indexOf(d[0])-1),l=l||(e&&0===r?o+1:e||11!==r?o:o-1),console.profile("createCal"),i=n(l,r),console.profileEnd("createCal"),$("#cal-frame",t).find(".curr").removeClass("curr").addClass("temp").end().prepend(i.calendar()).find(".temp").fadeOut("slow",function(){$(this).remove()});var f=i.label.trim().split(" ");console.log(f),a.find("#month").text(f[0]),a.find("#year").text(f[1])}function n(e,t){var a,r,l=1,i=!0,d=new Date(e,t,l).getDay(),o=[31,e%4==0&&e%100!=0||e%400==0?29:28,31,30,31,30,31,31,30,31,30,31],f=[];if(n.cache[e]){if(n.cache[e][t])return n.cache[e][t]}else n.cache[e]={};for(a=0;i;){for(f[a]=[],r=0;r<7;r++)0===a?r===d&&(f[a][r]=l++,d++):l<=o[t]?f[a][r]=l++:(f[a][r]="",i=!1),l>o[t]&&(i=!1);a++}if(f[5]){for(a=0;a<f[5].length;a++)""!==f[5][a]&&(f[4][a]="<span>"+f[4][a]+"</span><span>"+f[5][a]+"</span>");f=f.slice(0,5)}for(a=0;a<f.length;a++)f[a]="<tr><td>"+f[a].join("</td><td>")+"</td></tr>";return f=$("<table>"+f.join("")+"</table").addClass("curr"),$("td:empty",f).addClass("nil"),t===(new Date).getMonth()&&$("td",f).filter(function(){return $(this).text()===(new Date).getDate().toString()}).addClass("today"),n.cache[e][t]={calendar:function(){return f.clone()},label:c[t]+" "+e},n.cache[e][t]}var t,a,c=["JAN","FEB","MAR","APR","May","Jun","Jul","AUG","SEP","OCT","NOV","DEC"];return n.cache={},{init:function(n){t=$(n||"#cal"),a=t.find("#label"),t.find(".cal-pre").bind("click.calender",function(){e(!1)}),t.find(".cal-nxt").bind("click.calender",function(){e(!0)}),a.bind("click.calendar",function(){e(null,(new Date).getMonth(),(new Date).getFullYear())})},switchMonth:e,createCal:n}};