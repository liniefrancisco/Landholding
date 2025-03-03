 document.addEventListener("DOMContentLoaded", function(event){ 
                   var now = new Date();
                    var hh = now.getHours();
                    var min = now.getMinutes();
                    var d = now.getDate();
                    var year = now.getFullYear();
                    var u = $("#user").val();
                    var monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
                    var m_word = monthNames[now.getMonth()];         
                    var ampm = (hh>=12)?'PM':'AM';

                    hh = hh%12;
                    hh = hh?hh:12;
                    hh = hh<10?'0'+hh:hh;
                    min = min<10?'0'+min:min;
                            
                    var time = hh+":"+min+" "+ampm;
                    var a = ampm;
                    if(a == 'AM')
                    {
                      $("#display").text('Good Morning '+u+'!');
                      $("#da").text('Date : '+m_word+' '+d+','+year);
                    }
                    else if(a == 'PM' && hh<6)
                    {
                      $("#display").text('Good Afternoon '+u+'!');
                      $("#da").text('Date : '+m_word+' '+d+','+year);
                    }
                    else if( a == 'PM' && hh>=6)
                    {
                      $("#display").text('Good Evening '+u+'!');
                      $("#da").text('Date : '+m_word+' '+d+','+year);
                    } 

                    $(document).ready(function() {
                          var interval = setInterval(function() {
                              var momentNow = moment();
                              $('#ti').text('Time : '+momentNow.format('hh:mm:ss A'));
                          }, 1000);
                      });      
      });