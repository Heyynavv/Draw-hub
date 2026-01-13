document.addEventListener('DOMContentLoaded', () => {
    // 1. Date Fix: Current Weekly Draw Date
    const dateEl = document.getElementById('date');
    if(dateEl) dateEl.innerText = new Date().toLocaleDateString('en-GB');

    // 2. Build Prize Groups (Same as Daily labels)
    const container = document.getElementById('prize-container');
    const prizeNames = ["1st Prize Result", "2nd Prize Result", "3rd Prize - YOUR NUMBER", "4th Prize", "5th Prize", "6th Prize"];
    
    if(container) {
        container.innerHTML = ''; 
        prizeNames.forEach((name, idx) => {
            const isWinner = (idx === 2); // 3rd position check
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

    // 3. Footer Grids (Starter/Consolation)
    const fillGrid = (id) => {
        const el = document.getElementById(id);
        if(el) {
            el.innerHTML = '';
            for(let i=0; i<20; i++) {
                el.innerHTML += `<div class="grid-num">${Math.floor(1000 + Math.random() * 9000)}</div>`;
            }
        }
    }
    fillGrid('starter-grid');
    fillGrid('consolation-grid');

    // 4. Timer Logic
    let h=23, m=34, s=57; 
    setInterval(() => {
        const timerEl = document.getElementById('timer');
        if(timerEl) {
            s--; if(s<0){s=59; m--;} if(m<0){m=59; h--;}
            timerEl.innerText = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
        }
    }, 1000);

    // 5. Stop Animation & Inject Weekly DB Number
    setTimeout(() => {
        // global_user_lottery wahi hai jo PHP session se aaya hai
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
                    
                    // Match Logic: 3rd row mein Harleen ka Weekly number aayega
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
                    } else {
                        ball.style.background = "radial-gradient(circle at 30% 30%, #ff0000, #4a0000)";
                    }
                }, i * 180);
            });
        });
    }, 4000);
     // 60 seconds baad auto logout/redirect
setTimeout(() => {
    window.location.href = 'weekly.php';
}, 60000);
});