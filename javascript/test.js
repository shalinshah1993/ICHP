//This function is used to see whether user selects an option in every answer.
function validateOption()
{
    if(!(document.getElementById('option_1').checked || document.getElementById('option_2').checked || document.getElementById('option_3').checked || document.getElementById('option_4').checked)){
        document.getElementById("testPageError").style.display = "block";
        return false;
    }
    return true;
}

