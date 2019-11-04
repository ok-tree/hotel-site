

class hotel
{
	constructor(calendarTable, calendarYears, checkIn, checkOut)
	{
		this.calendarTable = calendarTable;
		this.calendarYears = calendarYears;
		this.checkIn = checkIn;
		this.checkOut = checkOut;
		
		this.monthCount = 0;
		this.startCell;
		this.endCell;
		this.startRow;
		this.endRow;
		
		this.tdSelect;
		this.nxetRow;
		this.firstSideDate;
		this.crossCheck = true;
		this.checkInValue;
		this.checkOutValue;

		this.endTableSelect = true;
		this.monthCount = 0;
		this.target;
	}
	
	prevCalendar(){
		this.makeCalendar(--this.monthCount);
	}

	nextCalendar(){
		this.makeCalendar(++this.monthCount);
	}
	thisCalendar(e){
		this.table = this.calendarTable[0];
		this.tdSelect = document.getElementsByClassName('calSelect');
		this.mainCalendar = true;
		if(!this.target){
			this.target = e.target;
			this.startRow = this.target.parentElement.rowIndex -2;
			this.startCell = this.target.cellIndex;
			this.table.rows[this.startRow].cells[this.startCell].setAttribute('class', 'calSelect');
			this.dateValue(this.table, "in", this.startRow, this.startCell);
		}else {
			this.target = e.target;
			this.endRow = this.target.parentElement.rowIndex -2;
			this.endCell = this.target.cellIndex;
			this.nextRow = ((this.endRow - this.startRow)*7)+this.endCell;

			if(this.startRow - this.endRow <= 0 && this.nextRow - this.startCell < 6 && this.nextRow - this.startCell > 0){
				for(let i=this.startCell; i<=this.nextRow; i++){
					if(i == 7){
						this.startRow++;
						this.nextRow = this.nextRow - 7;
						i=0;
					}
					this.table.rows[this.startRow].cells[i].setAttribute('class', 'calSelect');
					this.dateValue(this.table, "out", this.startRow, i);
				}
				this.startRow = 0;
				this.startCell = 0;
				this.mainCalendar = false;
			}else {
				for(let i=0,len=this.tdSelect.length; i<len; i++){
					this.tdSelect[0].classList.remove('calSelect');
				}
				this.startRow = this.target.parentElement.rowIndex -2;
				this.startCell = this.target.cellIndex;
				this.table.rows[this.startRow].cells[this.startCell].setAttribute('class', 'calSelect');
				this.dateValue(this.table, "in", this.startRow, this.startCell);
			}
		}
	}
	sideCalendar(e){
		this.table = this.calendarTable[1];
		this.tdSelect = document.getElementsByClassName('calSelect');

		if(!this.target){
			this.target = e.target;
			this.startRow = this.target.parentElement.rowIndex -2;
			this.startCell = this.target.cellIndex;
			this.table.rows[this.startRow].cells[this.startCell].setAttribute('class', 'calSelect');
			this.dateValue(this.table, "in", this.startRow, this.startCell);
		}else {
			this.target = e.target;
			this.endRow = this.target.parentElement.rowIndex -2;
			this.endCell = this.target.cellIndex;
			this.nextRow = ((this.endRow - this.startRow)*7)+this.endCell;

			if(this.startRow - this.endRow <= 0 && this.nextRow - this.startCell < 6 && this.nextRow - this.startCell > 0 && !this.mainCalendar && this.tdSelect.length < 2){
				for(let i=this.startCell; i<=this.nextRow; i++){
					if(i == 7){
						this.startRow++;
						this.nextRow = this.nextRow - 7;
						i=0;
					}
					this.table.rows[this.startRow].cells[i].setAttribute('class', 'calSelect');
					this.dateValue(this.table, "out", this.startRow, i);
				}
				this.startRow = 0;
				this.startCell = 0;
			}else if(this.mainCalendar ){
				this.mainTable = this.calendarTable[0];
				this.endRow = this.target.parentElement.rowIndex +3;
				this.endCell = this.target.cellIndex;
				this.nextRow = ((this.endRow - this.startRow - 1)*7)+this.endCell;
				this.firstSideDate = this.table.rows[0].cells[0];
				if(this.startCell > this.nextRow){
					this.nextRow = this.nextRow + 7;
				}

				if(this.nextRow - this.startCell < 6 && this.table.rows[(this.endRow-5)].cells[this.endCell].firstChild.nodeValue < 6){
					for(let i=this.startCell,len=this.nextRow; i<=len; i++){
						if(i == 7){
							this.startRow++;
							len = this.nextRow - 7;
							i = 0;
						}
						if(this.mainTable.rows[this.startRow].cells[i] && this.crossCheck && this.mainTable.rows[this.startRow].cells[i] != this.mainTable.rows[4].cells[7]){
							this.mainTable.rows[this.startRow].cells[i].setAttribute('class', 'calSelect');
							this.dateValue(this.table, "out", this.startRow, i);
						}else{
							if(this.crossCheck){
								this.startRow = 0;
							}	this.table.rows[this.startRow].cells[i].setAttribute('class', 'calSelect');			
							this.dateValue(this.table, "out", this.startRow, i);
							this.crossCheck = false;
						}
					}
					if(this.crossCheck){
						for(let i=0,len=this.tdSelect.length; i<len; i++){
						this.tdSelect[0].classList.remove('calSelect');
						}
						this.startRow = this.target.parentElement.rowIndex -2;
						this.startCell = this.target.cellIndex;
						this.table.rows[this.startRow].cells[this.startCell].setAttribute('class', 'calSelect');
						this.dateValue(this.table, "out", this.startRow, this.startCell);
					}
					this.crossCheck = true;

				}else {
					for(let i=0,len=this.tdSelect.length; i<len; i++){
						this.tdSelect[0].classList.remove('calSelect');
					}
					this.startRow = this.target.parentElement.rowIndex -2;
					this.startCell = this.target.cellIndex;
					this.table.rows[this.startRow].cells[this.startCell].setAttribute('class', 'calSelect');
					this.dateValue(this.table, "in", this.startRow, this.startCell);
				}
				this.mainCalendar = false;
			}else {

				for(let i=0,len=this.tdSelect.length; i<len; i++){
					this.tdSelect[0].classList.remove('calSelect');
				}
				this.startRow = this.target.parentElement.rowIndex -2;
				this.startCell = this.target.cellIndex;
				this.table.rows[this.startRow].cells[this.startCell].setAttribute('class', 'calSelect');
				this.dateValue(this.table, "in", this.startRow, this.startCell);
			}
		}
	}
	dateValue(table,inAndOut,row,cell){
		this.table = table;
		this.row = row;
		this.cell = cell;

		if(inAndOut == "in"){
			this.checkInValue = this.table.parentNode.getElementsByTagName("th");
			this.checkInValue = this.checkInValue[1].firstChild.nodeValue;
			this.checkInValue = this.checkInValue.replace("월", "-");
			this.checkInValue = this.checkInValue.replace(" ", "-");
			this.checkInValue += this.table.rows[this.row].cells[this.cell].firstChild.nodeValue;
			this.checkIn.setAttribute('value', this.checkInValue);
			this.checkOut.setAttribute('value', "");
		}else if(inAndOut = "out"){
			this.checkInValue = this.table.parentNode.getElementsByTagName("th");
			this.checkInValue = this.checkInValue[1].firstChild.nodeValue;
			this.checkInValue = this.checkInValue.replace("월", "-");
			this.checkInValue = this.checkInValue.replace(" ", "-");
			this.checkInValue += this.table.rows[this.row].cells[this.cell].firstChild.nodeValue;
			this.checkOut.setAttribute('value', this.checkInValue);
			this.table.parentNode.parentNode.classList.add("CALENDAR_SWITCH");
		}
	}
	makeCalendar(plusDay){

		let date = new Date();
		let today;
		let lastDay ;
		let row;
		let table;
		let years;
		
		for(var cal=0,len=this.calendarTable.length; cal<len; cal++){
			table = this.calendarTable[cal];
			years = this.calendarYears[cal];
			table.innerHTML = "";
			today = new Date(date.getFullYear(), date.getMonth()+cal + plusDay);
			lastDay = new Date(today.getFullYear(), today.getMonth()+1, 0);
			years.innerHTML = today.getFullYear() + " " + (today.getMonth() + 1 ) +  "월";
			row =
				table.insertRow((table.insertRow.lenght));

			for(var i=0; i<today.getDay(); i++){
				let cell = row.insertCell(i);
				cell.setAttribute('class','PREVIOUS_DAY_WHITE');
			}
			for(var j=1; j<=lastDay.getDate(); j++){
				let cel = (((i+j) % 7) - 1);
				let cell = row.insertCell(cel);
				if((i+j) % 7 == 0){
					cell.innerHTML = j;
					row =
					table.insertRow(table.insertRow.lenght);
				}else{	
					cell.innerHTML = j;
				}
				if(plusDay == 0 && cal == 0 && j < date.getDate()){
					cell.setAttribute('class','PREVIOUS_DAY');
				}
				if(plusDay == -1 && cal == 1 && j < date.getDate()){
					cell.setAttribute('class','PREVIOUS_DAY');
				}
				if(plusDay == -1 && cal == 0 && date > today){
					cell.setAttribute('class','PREVIOUS_DAY');
				}
				if(plusDay < -1 && date > today){
					cell.setAttribute('class','PREVIOUS_DAY');
				}
			}
		}
	}
}

function searchBar(){
	const CALENDAR = [ document.getElementById("firstCalendar"),
		document.getElementById("secondCalendar")
	];
	const CALENDAR_YEARS = [ document.getElementById("firstYears"),
		document.getElementById("secondYears")
	];
	
	
	if(CALENDAR[0] != null){
		const WRAP = document.getElementById("wrap");
		const COMPASS = document.getElementById("compass");
		const CHECK_IN = document.getElementById("checkIn");
		const CHECK_OUT = document.getElementById("checkOut");
		const PREV_MONTH = document.getElementById("prevMonth");
		const NEXT_MONTH = document.getElementById("nextMonth");
		const CAL_BOX = document.getElementById("calandarBox");
			
		CHECK_IN.addEventListener('click', function(){
			CAL_BOX.classList.toggle("CALENDAR_SWITCH");
		});
		CHECK_OUT.addEventListener('click', function(){
			CAL_BOX.classList.remove("CALENDAR_SWITCH");
		});

	
	
		let hotelSearch = new hotel(CALENDAR, CALENDAR_YEARS, CHECK_IN, CHECK_OUT);
		hotelSearch.makeCalendar(0);


		CALENDAR[0].addEventListener("click", function(e){
			hotelSearch.thisCalendar(e);
		});
		CALENDAR[1].addEventListener("click", function(e){
			hotelSearch.sideCalendar(e);
		});
		PREV_MONTH.addEventListener("click", function(){
			hotelSearch.prevCalendar();
		});
		NEXT_MONTH.addEventListener("click", function(){
			hotelSearch.nextCalendar();
		});
	}
}

function hotelReservation(){
	let CALENDAR = [document.getElementById("reservationCalendar")];
	const CALENDAR_YEARS = [document.getElementById("infoYears")];

	const CHECK_IN = document.getElementById("reservationCheckIn");
	const CHECK_OUT = document.getElementById("reservationCheckOut");
	const PREV_MONTH = document.getElementById("infoPrevMonth");
	const NEXT_MONTH = document.getElementById("infoNextMonth");

	if(CALENDAR[0] != null){
		let reservationSection = new hotel(CALENDAR, CALENDAR_YEARS, CHECK_IN, CHECK_OUT);
		reservationSection.makeCalendar(0);
	
		CALENDAR[0].addEventListener("click", function(e){
			reservationSection.thisCalendar(e);
		});
		PREV_MONTH.addEventListener("click", function(){
			reservationSection.prevCalendar();
		});
		NEXT_MONTH.addEventListener("click", function(){
			reservationSection.nextCalendar();
		});
	}
}

searchBar();
hotelReservation();
