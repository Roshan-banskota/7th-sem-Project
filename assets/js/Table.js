const noOfRows = 12;
const noOfCols = 5;

var tableArr = [];
var currentRow;

function displayTable() 
{
	for (var i = 0; i < tableArr.length; i++) 
	{
		displayRow();
		for (var j = 0; j < tableArr[i].length; j++) 
		{
			displayCol(tableArr[i][j].value,tableArr[i][j].span)
		}
	}
}

function displayRow() 
{
	var table = document.getElementById('routine-table');
	currentRow = table.insertRow();
}

function displayCol(value,span) 
{	
	var col = currentRow.insertCell();
	col.innerHTML = value;
	col.colSpan = span;
}

function col() 
{
	var colValue = document.getElementById('colValue').value;
	var colSpan = document.getElementById('colSpan').value;
	
	insertCol(colValue,colSpan);
}

function insertRow() 
{
	console.log(tableArr);
	tableArr.push([]);
}

function insertCol(colValue,colSpan) 
{
	var currentRowNo = tableArr.length - 1;
	var colObject = {value:colValue, span:colSpan};
	tableArr[currentRowNo].push(colObject);
}

