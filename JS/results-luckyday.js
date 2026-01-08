document.addEventListener('DOMContentLoaded', () => {
    // 1. Set Date
    document.getElementById('date').innerText = new Date().toLocaleDateString('en-GB');

    // 2. Build Prize Groups
    const container = document.getElementById('prize-container');
    const prizeNames = ["1st Prize Result", "2nd Prize Result", "3rd Prize - YOUR NUMBER", "4th Prize", "5th Prize", "6th Prize"];
    
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

    // 3. Populate 4x5 Footer Grids
    const fillGrid = (id) => {
        const el = document.getElementById(id);
        for(let i=0; i<20; i++) {
            el.innerHTML += `<div class="grid-num">${Math.floor(1000 + Math.random() * 9000)}</div>`;
        }
    }
    fillGrid('starter-grid');
    fillGrid('consolation-grid');

    // 4. Countdown Timer
    let h=23, m=35, s=5;
    setInterval(() => {
        s--; if(s<0){s=59; m--;} if(m<0){m=59; h--;}
        document.getElementById('timer').innerText = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
    }, 1000);

    // 5. Stop Animation after 4 seconds
    setTimeout(() => {
        prizeNames.forEach((_, idx) => {
            const isWin = (idx === 2);
            const balls = document.getElementById(`group-${idx}`).querySelectorAll('.ball');
            const strips = document.getElementById(`group-${idx}`).querySelectorAll('.digit-strip');

            balls.forEach((ball, i) => {
                setTimeout(() => {
                    ball.classList.remove('rolling');
                    strips[i].classList.remove('spinning');
                    strips[i].innerHTML = `<div class="text-xl font-black text-white">${Math.floor(Math.random()*10)}</div>`;
                    ball.style.background = "radial-gradient(circle at 30% 30%, #ff0000, #4a0000)";

                    if(isWin && i === balls.length - 1) {
                        document.getElementById('winner_section').classList.add('is-winner');
                        document.querySelector('.winner-text').style.opacity = '1';
                    }
                }, i * 180);
            });
        });
    }, 4000);
});