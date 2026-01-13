document.addEventListener('DOMContentLoaded', () => {
    // 1. Date Fix: "Loading" ki jagah current date dikhao
    const dateEl = document.getElementById('date');
    if(dateEl) dateEl.innerText = new Date().toLocaleDateString('en-GB');

    // 2. Prize Container Build
    const container = document.getElementById('prize-container');
    const prizeNames = ["1ST PRIZE RESULT", "2ND PRIZE RESULT", "3RD PRIZE - YOUR NUMBER", "4TH PRIZE", "5TH PRIZE", "6TH PRIZE"];
    
    if(container) {
        container.innerHTML = ''; // Fresh start
        prizeNames.forEach((name, idx) => {
            const isWinner = (idx === 2); 
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
    }

    // 3. Footer Sections Fix (Starter & Consolation)
    const fillGrid = (id) => {
        const el = document.getElementById(id);
        if(el) {
            el.innerHTML = ''; // Clear loading text
            for(let i=0; i<20; i++) {
                el.innerHTML += `<div class="grid-num">${Math.floor(1000 + Math.random() * 9000)}</div>`;
            }
        }
    }
    fillGrid('starter-grid');
    fillGrid('consolation-grid');

    // 4. Timer Logic
    let h=23, m=34, s=57; //
    setInterval(() => {
        const timerEl = document.getElementById('timer');
        if(timerEl) {
            s--; if(s<0){s=59; m--;} if(m<0){m=59; h--;}
            timerEl.innerText = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
        }
    }, 1000);

    // 5. Animation Stop & Number Match
    setTimeout(() => {
        const regDigits = (typeof global_user_lottery !== 'undefined' && global_user_lottery !== "") 
            ? global_user_lottery.toString().padStart(6, '0').split('') 
            : ['0','0','0','0','0','0'];

        prizeNames.forEach((_, idx) => {
            const isWin = (idx === 2);
            const group = document.getElementById(`group-${idx}`);
            if(!group) return;

            const balls = group.querySelectorAll('.ball');
            const strips = group.querySelectorAll('.digit-strip');

            balls.forEach((ball, i) => {
                setTimeout(() => {
                    ball.classList.remove('rolling');
                    strips[i].classList.remove('spinning');
                    
                    // Match Logic for 3rd Row
                    let finalDigit = isWin ? regDigits[i] : Math.floor(Math.random()*10);
                    strips[i].innerHTML = `<div class="text-xl font-black text-white">${finalDigit}</div>`;
                    
                    if(isWin) {
                        ball.style.background = "radial-gradient(circle at 30% 30%, #16a34a, #064e3b)";
                        if(i === balls.length - 1) {
                            const winSection = document.getElementById('winner_section');
                            if(winSection) winSection.classList.add('is-winner');
                            const winText = document.querySelector('.winner-text');
                            if(winText) winText.style.opacity = '1';
                        }
                    }
                }, i * 180);
            });
        });
    }, 4000);

    // 60 seconds baad auto logout/redirect
setTimeout(() => {
    window.location.href = 'luckyday.php';
}, 60000);
});