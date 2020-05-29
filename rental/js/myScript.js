function smoothScroll(element){
    document.querySelector(element).scrollIntoView({
        behavior: 'smooth'
    });
}

window.onscroll = function(){
    scroll();
}

function scroll(){
    if(document.body.scrollTop > 30 || document.documentElement.scrollTop > 30)
    {
        document.getElementById("up-button").style.display="block";
    }
    else
    {
        document.getElementById("up-bottom").style.display="none";
    }
}

function reserve(car){
    var select = document.getElementById('car');
    var options_selected = select.querySelectorAll('option[selected]');
    options_selected.forEach(function(option){
        option.removeAttribute("selected");
    });
    var option = select.querySelector('option[value="'+car+'"]');

    option.setAttribute("selected","selected");
    smoothScroll('#reservation');
}

function rental(car){
    var select = document.getElementById('car_2');
    var options_selected = select.querySelectorAll('option[selected]');
    options_selected.forEach(function(option){
        option.removeAttribute("selected");
    });
    var option = select.querySelector('option[value="'+car+'"]');

    option.setAttribute("selected","selected");
    smoothScroll('#rent');
}

function calculate(price){
    var result = document.getElementById('amount');
    result.innerHTML = '';
    var days = document.getElementById('days').value;
    var hours = document.getElementById('hours').value;
    var cost = (days*24*price) + (hours*price);
    result.innerHTML = cost;
    
}

function calculate_price(price){
    document.getElementById('days').addEventListener('change',function(){calculate(price)})
    document.getElementById('hours').addEventListener('change',function(){calculate(price)})
} 

function calculate_2(price_2){
    var result = document.getElementById('amount_2');
    result.innerHTML = '';
    var days = document.getElementById('days_2').value;
    var hours = document.getElementById('hours_2').value;
    var cost = (days*24*price_2) + (hours*price_2);
    result.innerHTML = cost;
    
}

function calculate_price_2(price_2){
    document.getElementById('days_2').addEventListener('change',function(){calculate_2(price_2)})
    document.getElementById('hours_2').addEventListener('change',function(){calculate_2(price_2)})
} 