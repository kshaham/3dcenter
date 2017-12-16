$(document).ready(function(){
        var calendar = $('#calendar').fullCalendar({
            header:{
                left: 'prev,next today',
                center: 'title',
                right: 'agendaWeek,agendaDay'
            },
            defaultView: 'agendaWeek',
            editable: true,
            selectable: true,
            allDaySlot: false,
            
            events: "index.php?view=1",
   
            
            eventClick:  function(event, jsEvent, view) {
                endtime = $.fullCalendar.moment(event.end).format('h:mm');
                starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
                var mywhen = starttime + ' - ' + endtime;
                $('#modalTitle').html(event.title);
				$('#modalPrinter').html(event.printer);
                $('#modalWhen').text(mywhen);
                $('#eventID').val(event.id);
                $('#calendarModal').modal();
            },
            
            //header and other values
            select: function(start, end, jsEvent) {
                endtime = $.fullCalendar.moment(end).format('h:mm');
                starttime = $.fullCalendar.moment(start).format('dddd, MMMM Do YYYY, h:mm');
                var mywhen = starttime + ' - ' + endtime;
                start = moment(start).format();
                end = moment(end).format();
                $('#createEventModal #startTime').val(start);
                $('#createEventModal #endTime').val(end);
                $('#createEventModal #when').text(mywhen);
                $('#createEventModal').modal('toggle');
           },
           eventDrop: function(event, delta){
               $.ajax({
                   url: 'index.php',
                   data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id ,
                   type: "POST",
                   success: function(json) {
                   //alert(json);
                   }
               });
           },
           eventResize: function(event) {
               $.ajax({
                   url: 'index.php',
                   data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id,
                   type: "POST",
                   success: function(json) {
                       //alert(json);
                   }
               });
           },
eventAfterRender: function (event, element, view) {
        var dataHoje = new Date();
        if (event.printer < 0) {
            //event.color = "#FFB347"; //Em andamento
           element.css('background-color', '#FF0000');
			} else if (event.printer == 0) {
            //event.color = "#77DD77"; //Concluído OK
              element.css('background-color', '#FFB347');
        } else if (event.printer == 1) {
            //event.color = "#77DD77"; //Concluído OK
            element.css('background-color', '#77DD77');
        } else if (event.printer == 2) {
            //event.color = "#AEC6CF"; //Não iniciado
            element.css('background-color', '#AEC6CF');
       } else if (event.start > dataHoje && event.end > dataHoje) {
            //event.color = "#AEC6CF"; //Não iniciado
            element.css('background-color', '#AEC6CF');
        }
    },
	eventRender: function (event, element, view) {
        var dataHoje = new Date();
         if (event.printer < 0) {
            //event.color = "#FFB347"; //Em andamento
           element.css('background-color', '#FF0000');
			} else if (event.printer == 0) {
            //event.color = "#77DD77"; //Concluído OK
              element.css('background-color', '#FFB347');
        } else if (event.printer == 1) {
            //event.color = "#77DD77"; //Concluído OK
            element.css('background-color', '#77DD77');
        } else if (event.printer == 2) {
            //event.color = "#AEC6CF"; //Não iniciado
            element.css('background-color', '#AEC6CF');
       } else if (event.start > dataHoje && event.end > dataHoje) {
            event.color = "#AEC6CF"; //Não iniciado
            element.css('background-color', '#AEC6CF');
        }
    }
        });
               
       $('#submitButton').on('click', function(e){
           // We don't want this to act as a link so cancel the link action
           e.preventDefault();
           doSubmit();
       });
       
       $('#deleteButton').on('click', function(e){
           // We don't want this to act as a link so cancel the link action
           e.preventDefault();
           doDelete();
       });
       function doDelete(){
           $("#calendarModal").modal('hide');
           var eventID = $('#eventID').val();
           $.ajax({
               url: 'index.php',
               data: 'action=delete&id='+eventID,
               type: "POST",
               success: function(json) {
                   if(json == 1)
                        $("#calendar").fullCalendar('removeEvents',eventID);
                   else
                        return false;
                    
                   
               }
           });
       }
       function doSubmit(){
           $("#createEventModal").modal('hide');
           var title = $('#title').val();
		   var printer = $('#printer').val();
           var startTime = $('#startTime').val();
           var endTime = $('#endTime').val();
           
           $.ajax({
               url: 'index.php',
               data: 'action=add&title='+title+'&printer='+printer+'&start='+startTime+'&end='+endTime,
               type: "POST",
               success: function(json) {
                   $("#calendar").fullCalendar('renderEvent',
                   {
                       id: json.id,
                       title: title,
					   printer: printer,
                       start: startTime,
                       end: endTime,
                   },
                   true);
               }
           });
           
       }
    });