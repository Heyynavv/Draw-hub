document.addEventListener('DOMContentLoaded', () => {
    // 1. PHP Session se registered number uthaya
    // Isse '232310' jaisa number JS array ban jayega: ["2","3","2","3","1","0"]
    const userRegNumber = "<?php echo $userLottery; ?>"; 
    const regDigits = userRegNumber.toString().padStart(6, '0').split(''); 

    // 2. Date Set karein
    const dateEl = document.getElementById('date');
    if(dateEl) dateEl.innerText = new Date().toLocaleDateString('en-GB');

    // 3. Prize Rows Create karein
    const container = document.getElementById('prize-container');
    const prizeNames = ["1st Prize Result", "2nd Prize Result", "3rd Prize - YOUR NUMBER", "4th Prize", "5th Prize", "6th Prize"];
    
    prizeNames.forEach((name, idx) => {
        const isWinner = (idx === 2); // 3rd Prize row
        const section = document.createElement('div');
        section.id = isWinner ? 'winner_section' : '';
        section.className = isWinner ? 'winner-section' : 'prize-group';
        
        section.innerHTML = `
            <div class="prize-banner ${isWinner ? '!bg-green-600 !text-white' : ''}">${name}</div>
            <div class="flex justify-center gap-2" id="group-${idx}">
                ${Array(6).fill(0).map(() => `
                    <div class="ball rolling">
                        <div class="digit-slot"><div class="digit-strip spinning">0 5 2 8 4 1 9 3 6 7</div></div>
                    </div>
                `).join('')}
            </div>
            ${isWinner ? '<p class="text-center text-green-500 font-black text-[10px] mt-4 tracking-[0.4em] uppercase opacity-0 winner-text">★ Congratulations Winner ★</p>' : ''}
        `;
        container.appendChild(section);
    });

    // 4. Timer aur Footer Grids (Tera purana code)
    const fillGrid = (id) => {
        const el = document.getElementById(id);
        if(!el) return;
        for(let i=0; i<20; i++) {
            el.innerHTML += `<div class="grid-num">${Math.floor(1000 + Math.random() * 9000)}</div>`;
        }
    }
    fillGrid('starter-grid');
    fillGrid('consolation-grid');

    let h=23, m=35, s=5;
    setInterval(() => {
        s--; if(s<0){s=59; m--;} if(m<0){m=59; h--;}
        const timerEl = document.getElementById('timer');
        if(timerEl) timerEl.innerText = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
    }, 1000);

    // 5. Animation Stop Logic (Yahan Number Match Hoga)
    setTimeout(() => {
        prizeNames.forEach((_, idx) => {
            const isWin = (idx === 2); 
            const balls = document.getElementById(`group-${idx}`).querySelectorAll('.ball');
            const strips = document.getElementById(`group-${idx}`).querySelectorAll('.digit-strip');

            balls.forEach((ball, i) => {
                setTimeout(() => {
                    ball.classList.remove('rolling');
                    strips[i].classList.remove('spinning');
                    
                    // Harleen ke case mein '232310' display hoga 3rd row mein
                    let finalDigit = isWin ? (regDigits[i] || '0') : Math.floor(Math.random()*10);
                    
                    strips[i].innerHTML = `<div class="text-xl font-black text-white">${finalDigit}</div>`;
                    
                    // Winner row ko Green gradient background
                    ball.style.background = isWin 
                        ? "radial-gradient(circle at 30% 30%, #16a34a, #064e3b)" 
                        : "radial-gradient(circle at 30% 30%, #ff0000, #4a0000)";

                    if(isWin && i === balls.length - 1) {
                        document.getElementById('winner_section').classList.add('is-winner');
                        const winText = document.querySelector('.winner-text');
                        if(winText) winText.style.opacity = '1';
                    }
                }, i * 180);
            });
        });
    }, 4000);
});