class CalcController{
    
    // Class constructor
    constructor(){
        this._locale          = 'pt-BR';
        this._displayCalcEl   = document.querySelector("#display");
        this._dateEl          = document.querySelector("#data");
        this._timeEl          = document.querySelector("#hora");
        this._currentDate;
        this.initialize();
        
    }

    // ===== Functions =====    
    initialize(){
        
        // Updates date and time each second
        this.setDisplayDateTime();
        setInterval(()=>{
            this.setDisplayDateTime();
        }, 1000);

    }

    initButtonsEvents(){
        let buttons = document.querySelectorAll("#buttons > g, #parts > g");
    }

    setDisplayDateTime(){
        this.displayTime = this.currentDate.toLocaleTimeString(this._locale);
        this.displayDate = this.currentDate.toLocaleDateString(this._locale,{day: '2-digit', month: 'long', year: 'numeric'});
    }

    // ===== Getters & Setters =====
    // Display calculator
    get displayCalc(){
        return this._displayCalcEl.innerHTML;
    }

    set displayCalc(value){
        this._displayCalcEl.innerHTML = value;
    }

    // Time calculator
    get displayTime(){
        return this._timeEl.innerHTML;
    }

    set displayTime(value){
        this._timeEl.innerHTML = value;
    }

    // Date calculator
    get displayDate(){
        return this._dateEl.innerHTML;
    }

    set displayDate(value){
        this._dateEl.innerHTML = value;
    }

    // Return date instance
    get currentDate(){
        return new Date();
    }

    set currentDate(value){
        this._currentDate = value;
    }

}