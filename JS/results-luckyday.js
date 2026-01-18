document.addEventListener('DOMContentLoaded', () => {
    // 1. Prize Container Setup
    const container = document.getElementById('prize-container');
    
    // Prize Names aur unke corresponding Amounts ki list
    const prizes = [
        { name: "1ST PRIZE ", amount: "AED 400000" },
        { name: "2ND PRIZE ", amount: "AED 200000" },
        { name: "3RD PRIZE ", amount: "AED 50000" },
        { name: "4TH PRIZE", amount: "AED 40000" },
        { name: "5TH PRIZE", amount: "AED 20000" },
        { name: "6TH PRIZE", amount: "AED 5000" }
    ];
    
    if(container) {
        container.innerHTML = ''; 
        prizes.forEach((prize, idx) => {
            const isWinner = (idx === 2); 
            const section = document.createElement('div');
            section.id = isWinner ? 'winner_section' : '';
            section.className = isWinner ? 'winner-section' : 'prize-group';
            
            // Banner ke andar flex aur justify-between dala hai
            section.innerHTML = `
                <div class="prize-banner flex justify-between items-center px-4 ${isWinner ? '!bg-green-600 !text-black' : ''}">
                    <span>${prize.name}</span>
                    <span class="font-black ">${prize.amount}</span>
                </div>
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

    // 2. Footer Grids
    const fillGrid = (id) => {
        const el = document.getElementById(id);
        if(el) {
            el.innerHTML = ''; 
            for(let i=0; i<20; i++) {
                el.innerHTML += `<div class="grid-num" style="background:rgb(255, 255, 255); color:black; padding:5px; border-radius:5px; text-align:center; font-weight:bold; font-size:10px; border:1px solid #ddd;">${Math.floor(1000 + Math.random() * 9000)}</div>`;
            }
        }
    }
    fillGrid('starter-grid');
    fillGrid('consolation-grid');

    // 3. Timer Logic
    let h=23, m=34, s=57;
    setInterval(() => {
        const timerEl = document.getElementById('timer');
        if(timerEl) {
            s--; if(s<0){s=59; m--;} if(m<0){m=59; h--;}
            timerEl.innerText = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
        }
    }, 1000);

    // 4. Animation Stop Logic
    setTimeout(() => {
        const regDigits = (typeof global_user_lottery !== 'undefined' && global_user_lottery !== "") 
            ? global_user_lottery.toString().padStart(6, '0').split('') 
            : ['0','0','0','0','0','0'];

        prizes.forEach((_, idx) => {
            const isWin = (idx === 2);
            const group = document.getElementById(`group-${idx}`);
            if(!group) return;

            const balls = group.querySelectorAll('.ball');
            const strips = group.querySelectorAll('.digit-strip');

            balls.forEach((ball, i) => {
                setTimeout(() => {
                    ball.classList.remove('rolling');
                    strips[i].classList.remove('spinning');
                    
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
    }, 8000);
});