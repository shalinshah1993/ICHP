//This function is used to see whether user selects an option in every answer.
function validateOption()
{
    if(!(document.getElementById('option_1').checked || document.getElementById('option_2').checked || document.getElementById('option_3').checked || document.getElementById('option_4').checked)){
        document.getElementById("testPageError").style.display = "block";
        return false;
    }

    document.getElementById("testPageTimer").value = document.getElementById("testPageTime").innerHTML;
    return true;
}


// record start time
var startTime;
function display() {
    // later record end time
    var endTime = new Date();

    // time difference in ms
    var timeDiff = endTime - startTime;

    // strip the miliseconds
    timeDiff /= 1000;

    // get seconds
    var seconds = Math.round(timeDiff % 60);

    // remove seconds from the date
    timeDiff = Math.floor(timeDiff / 60);

    // get minutes
    var minutes = Math.round(timeDiff % 60);

    // remove minutes from the date
    timeDiff = Math.floor(timeDiff / 60);

    // get hours
    var hours = Math.round(timeDiff % 24);

    //$(".time").text(hours + ":" + minutes + ":" + seconds);
    setTimeout(display, 1000);
    console.log(timeDiff);
    document.getElementById('testPageTimeShow').innerHTML = minutes + ":" + seconds;
    document.getElementById('testPageTime').innerHTML = timeDiff;
}
startTime = new Date();
setTimeout(display, 1000);