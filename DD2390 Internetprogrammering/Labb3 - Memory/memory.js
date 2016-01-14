// JavaScript Document
var score_player1 = 0, score_player2 = 0;
var player1_turn;
//Player is given two chances at a time to find a pair,
// -1 tells no earlier guess at this turn and this player has been done
var last_guess=-1;
var number_of_pairs_found;
/*Each index in array corspondings to a given field in the table of the game 
A value of -1 is set when this card has been found*/
var corsponding_value = new Array();
var value_to_find = new Array(false,false,false,false,false,false,false,false);
var card_last;
var card_current;

//Sets or reset the gameboard(also responsible for generating position of each card)
function initGame()
{
    
    player1_turn = true;
    number_of_pairs_found=0;
    var l = new Array(0,0,1,1,2,2,3,3,4,4,5,5,6,6,7,7);
    corsponding_value = new Array();
    var number_found=-1;
    var n=-1;
    for(var i=0; i<16; i++)
    {
        do
        {
            number_found = Math.round(Math.random() * 7);
            n = l.indexOf(number_found);
        }while(n==-1);
    l.splice(n,1);
    corsponding_value[i]=number_found; 
    
    }
}

//Set the look for the game table
function setTableLook()
{
    document.getElementById("btn").disabled=true;//Hide new game button
    var table=document.getElementById("t");
    table["rules"]="all";
    table["style"]["border"]="thin solid blue";
    var row = table.rows;
    for(var i=0; i<4; i++)
    {
        var cell = row[i].cells;
        for(var j=0; j<4; j++)
        {
            //var text=document.createTextNode(i+j);
            var img = row[i].cells[j].getElementsByTagName("img");
            mouseDefault(img[0]);
        }
    }
    initGame();
}

//Uppdate score value and fields
function updateScore(player)
{
    if(player1_turn == true)
        document.getElementById("player1").innerHTML="player1 score: " +  ++score_player1; 
    else
        document.getElementById("player2").innerHTML="player2 score: " + ++score_player2; 
}

//reset score 
function resetScore()
{
    score_player1 = 0;
    score_player2 = 0;
    document.getElementById("player1").innerHTML="player1 score: " +  score_player1;
    document.getElementById("player2").innerHTML="player2 score: " +  score_player2;
}

//Handle mouse-event onclick and onmouse down at table cells
function mouseClick(x)
{
    showCard(x);
    //drawing first card at its turn
    if(last_guess ==-1)
    {
        card_last = x;
        last_guess = parseInt(x.id);
    }
    //drawing second card at its turn
    else 
    {
        var current_guess = parseInt(x.id);
        
        //correct guess (not same choosen table cell && pair not found earlier)
        if( last_guess != current_guess &&
            corsponding_value[last_guess] == corsponding_value[current_guess] && 
            !value_to_find[corsponding_value[current_guess]])
        {
            showCard(card_last);
            value_to_find[corsponding_value[current_guess]] = true;
            updateScore(player1);
            ++number_of_pairs_found;
            last_guess = -1;
        }
        //wrong guess, time to let the other player have a go.
        else 
        {
            changeTurn();//resets the guess counter and changes players turn
        }   
    }
    
    //if all pair are found
    if(number_of_pairs_found > 7)
            {   
                var player1_win="Player one wins! ";
                var player2_win="Player two wins! ";
                if(score_player1==score_player2)
                    document.getElementById("players_turn").innerHTML= "It's a tie!";
                else
                    document.getElementById("players_turn").innerHTML=(score_player1 > score_player2)? player1_win : player2_win;
                //show the restart button            
                document.getElementById("btn").disabled=false;
            }
}

//reset values and regenerate the game table
function restartGame()
{
    value_to_find=new Array(false,false,false,false,false,false,false,false);
    document.getElementById("players_turn").innerHTML= "Player one turn!";
    resetScore();
    setTableLook();
}

//changing turn(next player will pick two card)
function changeTurn()
{
    player1_turn = !player1_turn;
    document.getElementById("players_turn").innerHTML= (player1_turn)?"Player one turn!":"Player two turn!";
    last_guess=-1;
}

//Show the actual card
function showCard(x)
{ 
    x.src="card"+ corsponding_value[x.id] +".png";
}

//The event that mouse is hoovering over a card(table cell)
function mouseOver(x)
{
    if(value_to_find[corsponding_value[parseInt(x.id)]])
        showCard(x);
    else
        x.src="cardHover.png";
}

//The even that mouse stops hoovering over a card(table cell)
function mouseOut(x)
{
    //if the card belongs to a pair that is found, let it be
    if(value_to_find[corsponding_value[parseInt(x.id)]])
        showCard(x);
    else
        x.src="cardNormal.png";
}

//sets default look of each card
function mouseDefault(x)
{
    x.width="50";
    x.height="40";
    mouseOut(x);
}
