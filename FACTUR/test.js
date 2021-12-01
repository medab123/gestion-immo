 var inputs;
document.addEventListener("DOMContentLoaded", function(event) {
    var form = document.getElementById('formId');
    inputs = form.getElementsByTagName("input");
    for(var i = 0 ; i < inputs.length;i++) {
        inputs[i].addEventListener('keydown', function(e){
            if(e.keyCode == 13) {
                var currentIndex = findElement(e.target)
                if(currentIndex > -1 && currentIndex < inputs.length) {
                    inputs[currentIndex+1].focus();
                }
            }   
        });
    }
});

function findElement(element) {
    var index = -1;
    for(var i = 0; i < inputs.length; i++) {
        if(inputs[i] == element) {
            return i;
        }
    }
    return index;
}

