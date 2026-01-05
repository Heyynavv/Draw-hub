document.addEventListener('DOMContentLoaded', () => {
    // 1. Set Current Date
    document.getElementById('date').innerText = new Date().toLocaleDateString('en-GB');

    // 2. Start Countdown Timer
    startTimer();

    // 3. Start Casino Roll Effect
    startShow();
});

function startShow() {
    // Select all digit containers
    const group0 = document.getElementById('group-0'); // 1st
    const group1 = document.getElementById('group-1'); // 2nd
    const group2 = document.getElementById('group-2'); // 3rd (Winner)
    const group3 = document.getElementById('group-3'); // 4th

    // Sequential Stop Logic
    setTimeout(() => stopDigits(group0), 1000);         // Stop 1st Prize
    setTimeout(() => stopDigits(group1), 2000);         // Stop 2nd Prize
    setTimeout(() => stopDigits(group3), 3000);         // Stop 4th Prize
    setTimeout(() => stopDigits(group2, true), 4500);   // Stop 3rd Prize (Winner) Last
}

function stopDigits(container, isWinner = false) {
    const digits = container.querySelectorAll('.digit');
    digits.forEach((d, i) => {
        setTimeout(() => {
            d.classList.remove('rolling');
            d.innerText = Math.floor(Math.random() * 10);
            
            // If it's the winning group and the last digit has stopped
            if(isWinner && i === digits.length - 1) {
                document.getElementById('winner_section').classList.add('is-winner');
            }
        }, i * 150); // Small delay between each circle stopping
    });
}

function startTimer() {
    let h = 23, m = 35, s = 5;
    const timerEl = document.getElementById('timer');
    
    setInterval(() => {
        s--;
        if (s < 0) { s = 59; m--; }
        if (m < 0) { m = 59; h--; }
        
        timerEl.innerText = 
            `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
    }, 1000);
}