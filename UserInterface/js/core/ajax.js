var aanwezig = "aanwezig";
var afwezig = "afwezig";

// get all coachgroups from API
// @return JSON {all coach.groups}
// @return button value coach.id 
function getAllCoachGroups()
{
    var url = "http://devallei.dev:8000/api/v1/coachgroep/alle";

    return $.getJSON(url, function(data){
                    
        $.each(data, function(i, coach){
                                                            
            $("#coachGroupOutput").append("<button type='button' class='btn btn-block coachGroupButton' value='"+coach.id+"'>"+coach.coach+"</button>"+" <br><br>");      
        });

        $('.coachGroupButton').click(function(){  
            $("#coachColumn").fadeOut("fast");
            $("#arrowBack").animate({opacity: "1"});
            
            getCoachGroupStudents(this.value);
        });  
    });
}

//  get all students from API related to coachgroup
//  @var coach.id (clicked button value)
//  @return JSON {all the choachgroups students student[studentdata] / student[status]}
//  @return button value student.id
function getCoachGroupStudents(id)
{
    var url = "http://devallei.dev:8000/api/v1/coachgroep/"+id
    
    $("#studentColumn").fadeIn("slow");

    $("#studentsOutput").empty();
    // get all student from coachgroup                    
    return $.getJSON(url, function(data) {  
        
        $.each(data, function(i, student) {
                        
            $("#studentsOutput").append("<button id='studentBtn_"+student.id+"' type='button' class='btn btn-block studentButton'  name='"+student.studentdata.voornaam+"' value='"+student.id+"' style='background:"+student.status.color+"'>"+student.studentdata.voornaam+"</button> <br> <br>");
        });

        $('.studentButton').click(function() {
          
            var studentId = this.value;
            var studentName = this.name;
            var url = 'http://devallei.dev:8000/api/v1/leerlingen/status/'+studentId;
            // get student status
            $.getJSON(url, function(data) {
                if (data.status !== aanwezig) {
                    bootbox.confirm("Hallo "+studentName+", wil je je aanmelden?", function(result) {
                        if(result) {
                            updateStudentStatus(studentId, aanwezig)
                        }

                    });
                }

                if (data.status == aanwezig) {

                    bootbox.confirm("Wil je je afmelden?", function(result) {
                        
                        if(result) {

                            var url = 'http://devallei.dev:8000/api/v1/statuses/selectable';
                            // get status options JSON
                            $.getJSON(url, function(data) {
                                var header = "Kies één van de knoppen om je af te melden:"
                                var modal = new Modal(studentId, header, data);
                                
                                $("#modalOutput").html(modal.getModal());
                                $("#modal_"+studentId).modal({backdrop: "static"});

                                $("#modal_"+studentId).on('hidden.bs.modal', 
                                    function() {
                                        var studentId = $("#signOutId").val();
                                        var status = $("#signOutStatus").val();
                                        var reasonRequierd = $("#signOutR_R").val();
                                        
                                        $("#signOutId").val("");
                                        $("#signOutStatus").val("");
                                        $("#signOutR_R").val("");
                                        

                                        if (reasonRequierd == true) {

                                            openReasonPrompt(studentId, status);

                                            function openReasonPrompt(studentId, status) {
                                            var reason = "";

                                                bootbox.prompt("Met welke reden ga je "+status+"?", 
                                                    function callback(result) {
                                                        if (result !== null && result !== "") {

                                                            reason = result;
                                                            updateStudentStatus(studentId, status, reason); 
                                                        } else {
                                                            bootbox.alert("Je bent vegeten een reden op te geven.", function(){    
                                                                openReasonPrompt(studentId, status);
                                                            });
                                                        }
                                                
                                                });
                                            }
                                           
                                        } else {
                                            updateStudentStatus(studentId, status); 
                                        } // close if reasonRequierd
                                                                         
                                }); // close on modal close
                                
                            }); // close getJSON status options
                        } // close if result
                    }) // close confirm aanmelden                   
                } // close if aanwezig
            }); // close getJSON student status  
        }); // close student button click function
    }); // close getJSON coach group student
} // close getCoachGroupStudents function


function updateStudentStatus(student_id, status, reason) 
{
    // console.log(reason);

    var url = 'http://devallei.dev:8000/api/v1/leerlingen/updatestatus/'+student_id;

    $.post(url, {
        'status':status, 
        'reden':reason
    },  function(satus) 
        {
            console.log("satus response from API: ");
            console.log(satus);
            
        }, "json").done(function(satus){
                $("#studentBtn_"+student_id).css({'background': satus.color});
            });    
}