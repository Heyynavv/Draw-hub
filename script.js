// --- Carousel Control ---

let currentSlide = 0;
const track = document.getElementById('carouselTrack');
const dotsContainer = document.getElementById('carouselDots');

// Important: Select slides inside the function or after DOM load
const slides = document.querySelectorAll('.carousel-slide');

// Create Dots dynamically based on number of slides
dotsContainer.innerHTML = ''; // Clear existing dots if any
slides.forEach((_, i) => {
    const dot = document.createElement('div');
    // Dot styling (Make sure you have .dot and .active CSS)
    dot.className = `w-3 h-3 rounded-full bg-white/30 cursor-pointer transition-all duration-300 ${i === 0 ? 'bg-green-500 w-8' : ''}`;
    dot.onclick = () => goToSlide(i);
    dotsContainer.appendChild(dot);
});

const dots = dotsContainer.children;

function updateSlider() {
    track.style.transform = `translateX(-${currentSlide * 100}%)`;
    // Update dots appearance
    Array.from(dots).forEach((dot, i) => {
        if (i === currentSlide) {
            dot.classList.add('bg-green-500', 'w-8');
            dot.classList.remove('bg-white/30');
        } else {
            dot.classList.remove('bg-green-500', 'w-8');
            dot.classList.add('bg-white/30');
        }
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    updateSlider();
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    updateSlider();
}

function goToSlide(index) {
    currentSlide = index;
    updateSlider();
}

// Auto Play Logic
let autoPlay = setInterval(nextSlide, 3000);

const container = document.querySelector('.carousel-container');
container.addEventListener('mouseenter', () => clearInterval(autoPlay));
container.addEventListener('mouseleave', () => {
    clearInterval(autoPlay); // Clean old interval
    autoPlay = setInterval(nextSlide, 3000);
});
    

// --- Sidebar Control ---
// const burger = document.getElementById('hamburger');
// const sidebar = document.getElementById('mobile-sidebar');
// const closeBtn = document.getElementById('close-menu');
// const overlay = document.getElementById('mobile-overlay');

// if(burger) {
//     burger.onclick = () => {
//         sidebar.classList.add('sidebar-open');
//         overlay.style.display = 'block';
//     }
// }

// const closeSidebar = () => {
//     sidebar.classList.remove('sidebar-open');
//     overlay.style.display = 'none';
// }

// if(closeBtn) closeBtn.onclick = closeSidebar;
// if(overlay) overlay.onclick = closeSidebar;

document.addEventListener('DOMContentLoaded', () => {
    const burger = document.getElementById('hamburger');
    const sidebar = document.getElementById('mobile-sidebar');
    const closeBtn = document.getElementById('close-menu');
    const overlay = document.getElementById('mobile-overlay');

    if(burger) {
        burger.onclick = () => {
            sidebar.classList.add('sidebar-open');
            overlay.style.display = 'block';
        }
    }

    const closeSidebar = (e) => {
        if(e) e.stopPropagation();
        sidebar.classList.remove('sidebar-open');
        overlay.style.display = 'none';
    }

    if(closeBtn) closeBtn.onclick = closeSidebar;
    if(overlay) overlay.onclick = closeSidebar;
});

// Modal Logic
window.openResultsModal = function() {
    const modal = document.getElementById('results-modal');
    if(modal) modal.style.display = 'flex';
};

window.closeResultsModal = function() {
    const modal = document.getElementById('results-modal');
    if(modal) modal.style.display = 'none';
};


// --- Jackpot Grid Generation ---
const jackGrid = document.getElementById('jackpot-grid');
if(jackGrid) {
    for(let i=1; i<=31; i++) {
        const val = i < 10 ? '0' + i : i;
        jackGrid.innerHTML += `<div class="w-8 h-8 md:w-10 md:h-10 rounded-full border border-gray-200 bg-white flex items-center justify-center text-[10px] font-bold text-gray-400 hover:bg-green-700 hover:text-white cursor-pointer transition">${val}</div>`;
    }
}

// --- Scratch Cards Generation (16 Cards) ---

// --- Scratch Cards Generation (16 Cards) ---
const scratchGrid = document.getElementById('scratch-grid');

// Maine extensions yahan set kar di hain (5, 6, 8, 12, 13, 16 ko .png kiya hai)
const cardData = [
    {name:'Cash Splash', price:50, win:'1,000,000', color:'bg-[#1b8c38]', ext:'jpg'},
    {name:'House of Gold', price:20, win:'300,000', color:'bg-[#c41e3a]', ext:'jpg'},
    {name:'Jungle Jewels', price:10, win:'100,000', color:'bg-[#0b4d2a]', ext:'jpg'},
    {name:'Wicket Win', price:5, win:'50,000', color:'bg-[#2b4c91]', ext:'jpg'},
    {name:'Mega Million', price:100, win:'5,000,000', color:'bg-[#4c1a59]', ext:'png'}, // Card 5
    {name:'Diamond 777', price:30, win:'750,000', color:'bg-[#0e7490]', ext:'png'},    // Card 6
    {name:'Lucky Red', price:20, win:'250,000', color:'bg-[#9f1239]', ext:'jpg'},
    {name:'Silver Box', price:15, win:'150,000', color:'bg-[#475569]', ext:'png'},    // Card 8
    {name:'Royal Flush', price:50, win:'1,200,000', color:'bg-[#312e81]', ext:'jpg'},
    {name:'Neon Win', price:25, win:'200,000', color:'bg-[#be185d]', ext:'jpg'},
    {name:'Game On', price:40, win:'800,000', color:'bg-[#c2410c]', ext:'jpg'},
    {name:'Pixel Cash', price:10, win:'100,000', color:'bg-[#0e7490]', ext:'png'},    // Card 12
    {name:'Vortex', price:50, win:'1,500,000', color:'bg-[#4c1d95]', ext:'png'},    // Card 13
    {name:'Office Win', price:20, win:'300,000', color:'bg-[#065f46]', ext:'jpg'},
    {name:'Gold Rush', price:100, win:'10,000,000', color:'bg-[#b45309]', ext:'jpg'},
    {name:'Pocket Money', price:5, win:'25,000', color:'bg-[#0d9488]', ext:'png'}     // Card 16
];

if(scratchGrid) {
    scratchGrid.innerHTML = '';
    cardData.forEach((c, i) => {
        const cardNumber = i + 1;
        // Har card apni specific extension ke saath load hoga
        const imgPath = `assets/images/card${cardNumber}.${c.ext}`;

        scratchGrid.innerHTML += `
            <div class="group relative bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 cursor-pointer border border-slate-100">
                
                <div class="absolute top-3 right-3 z-20 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-lg shadow-sm border border-white/50 flex flex-col items-center">
                    <span class="text-[7px] font-black text-slate-400 leading-none uppercase">AED</span>
                    <span class="text-sm font-black text-slate-900 leading-none">${c.price}</span>
                </div>

                <div class="relative h-48 sm:h-56 lg:h-48 overflow-hidden bg-gray-100">
                    <img src="${imgPath}" 
                         alt="${c.name}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    
                    <div class="absolute bottom-3 left-0 right-0 px-4 text-center">
                        <h4 class="text-white text-base font-black uppercase italic tracking-tighter drop-shadow-lg">
                            ${c.name}
                        </h4>
                    </div>
                </div>

                <div class="${c.color} py-2.5 px-2 text-center relative">
                    <p class="text-[8px] font-bold text-white/70 uppercase tracking-widest leading-none mb-1">Win Up To</p>
                    <p class="text-sm font-black text-white italic tracking-tighter leading-none">
                        AED ${c.win}
                    </p>
                </div>
            </div>
        `;
    });
}

// --- Casino Slot Logic ---
const winNums = [10, 22, 5, 31, 48, 7, 2];
function initSlots() {
    const container = document.getElementById('slot-container');
    if(!container) return;
    winNums.forEach((n, i) => {
        let ball = `<div class="slot-ball"><div class="reel" id="reel-${i}">`;
        for(let x=0; x<15; x++) ball += `<div>${Math.floor(Math.random()*49)+1}</div>`;
        ball += `<div class="${i===6?'bg-red-600 text-white':''}">${n}</div></div></div>`;
        container.innerHTML += ball;
    });
}

window.spinCasino = function() {
    winNums.forEach((_, i) => {
        const r = document.getElementById(`reel-${i}`);
        if(r) { 
            r.style.transition = 'none'; 
            r.style.transform = 'translateY(0)';
            setTimeout(() => { 
                r.style.transition = 'transform 2s cubic-bezier(0.15, 0.88, 0.3, 1)'; 
                r.style.transform = `translateY(-${15 * 36}px)`; 
            }, 50); 
        }
    });
}

// --- Winner Ticker ---

const tickerWrap = document.getElementById('ticker-wrap');

if(tickerWrap) {
    // Unique Names aur Data
    const winnersData = [
        {name: "Jehanze** S**", amount: "100,000", game: "Lucky Day", date: "03/01/2026", type: "lucky-chance"},
        {name: "Murad A**", amount: "1,000", game: "Lucky Day", date: "03/01/2026", type: "normal"},
        {name: "Muhamme** B**", amount: "1,000", game: "Lucky Day", date: "03/01/2026", type: "normal"},
        {name: "Imran s** I**", amount: "2,500", game: "Pick 3", date: "03/01/2026", type: "normal"},
        {name: "Albin B** A**", amount: "1,000", game: "Lucky Day", date: "03/01/2026", type: "normal"},
        {name: "Siva G**", amount: "1,000", game: "Scratch Cards", date: "03/01/2026", type: "normal"},
        {name: "Rahul K**", amount: "5,000", game: "Pick 4", date: "04/01/2026", type: "normal"},
        {name: "Ahmed M**", amount: "1,500", game: "Lucky Day", date: "04/01/2026", type: "normal"}
    ];

    let cardsHTML = '';
    // Infinite scroll ke liye double kiya
    const fullList = [...winnersData, ...winnersData];

    fullList.forEach((w, index) => {
        // Sirf pehle index wala card 'Lucky Chance' header ke saath aayega
        if(w.type === "lucky-chance" && index === 0) {
            cardsHTML += `
                <div class="inline-block mx-4 min-w-[250px]">
                    <div class="bg-white rounded-2xl shadow-[0_10px_25px_-5px_rgba(251,191,36,0.3)] border-2 border-amber-400 text-center relative overflow-hidden h-[190px]">
                        <div class="bg-gradient-to-r from-amber-400 via-orange-500 to-amber-500 py-2.5 mb-4 relative z-10 shadow-sm">
                            <span class="text-white font-black uppercase italic text-xs tracking-widest">LUCKY CHANCE</span>
                        </div>
                        <p class="text-slate-800 font-black text-lg mt-1">${w.name}</p>
                        <p class="text-3xl font-black text-orange-600 my-1 drop-shadow-sm">AED ${w.amount}</p>
                        <div class="mt-2">
                            <p class="text-[11px] font-extrabold text-slate-500 uppercase tracking-tight">${w.game}</p>
                            <p class="text-[9px] text-slate-400 font-bold">${w.date}</p>
                        </div>
                    </div>
                </div>
            `;
        } else {
            // High-Contrast Normal Winner Card
            cardsHTML += `
                <div class="inline-block mx-4 min-w-[220px]">
                    <div class="bg-white rounded-2xl p-5 shadow-[0_8px_20px_-6px_rgba(0,0,0,0.15)] border border-gray-100 text-center relative h-[180px] flex flex-col justify-center transform hover:scale-105 transition-transform">
                        <div class="absolute top-0 left-1/2 -translate-x-1/2">
                             <div class="bg-green-600 text-white text-[9px] font-black px-4 py-0.5 rounded-b-md uppercase shadow-sm">Winner</div>
                        </div>
                        <div class="mb-2">
                             <img src="https://cdn-icons-png.flaticon.com/512/3112/3112946.png" class="w-7 h-7 mx-auto" alt="win icon">
                        </div>
                        <p class="text-slate-800 font-black text-base">${w.name}</p>
                        <p class="text-2xl font-black text-[#1fb141] drop-shadow-sm">AED ${w.amount}</p>
                        <div class="mt-3 border-t border-gray-100 pt-2">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-tighter">${w.game}</p>
                            <p class="text-[9px] text-gray-400 font-bold">${w.date}</p>
                        </div>
                    </div>
                </div>
            `;
        }
    });

    tickerWrap.innerHTML = `<div class="ticker-container">${cardsHTML}</div>`;
}

// --- Timer Logic ---
setInterval(() => {
    const now = new Date();
    const timeStr = `${23-now.getHours()}:${59-now.getMinutes()}:${59-now.getSeconds()}`;
    document.querySelectorAll('.main-timer-el, .nav-timer-el').forEach(el => el.innerText = timeStr);
}, 1000);

window.onload = initSlots;

//- Lotto timer login //

function startLottoTimers() {
    // 1 Minute Instant Timer
    setInterval(() => {
        const now = new Date();
        const seconds = 59 - now.getSeconds();
        const displaySec = seconds < 10 ? '0' + seconds : seconds;
        
        const instTimer = document.getElementById('instant-timer');
        if(instTimer) {
            instTimer.querySelector('.minutes').innerText = '00';
            instTimer.querySelector('.seconds').innerText = displaySec;
        }
    }, 1000);

    // Countdown function for Pick 3 and Pick 4
    function updateCountdown(id, targetHour) {
        const timerContainer = document.getElementById(id);
        if (!timerContainer) return;

        const now = new Date();
        let target = new Date();
        target.setHours(targetHour, 0, 0, 0);

        if (now > target) target.setDate(target.getDate() + 1);

        const diff = target - now;
        const h = Math.floor(diff / (1000 * 60 * 60));
        const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const s = Math.floor((diff % (1000 * 60)) / 1000);

        timerContainer.querySelector('.hours').innerText = h < 10 ? '0' + h : h;
        timerContainer.querySelector('.minutes').innerText = m < 10 ? '0' + m : m;
        timerContainer.querySelector('.seconds').innerText = s < 10 ? '0' + s : s;
    }

    setInterval(() => {
        updateCountdown('pick3-timer', 22); // Target 10 PM
        updateCountdown('pick4-timer', 20); // Target 8 PM
    }, 1000);
}

startLottoTimers();



// Window load hone par start karein
document.addEventListener('DOMContentLoaded', startLottoTimers);


// Jackpot logic //



    function renderTicketNumbers() {
        const daysGrid = document.getElementById('ticket-days-grid');
        const monthsGrid = document.getElementById('ticket-months-grid');

        // Generate 1-31
        for (let i = 1; i <= 31; i++) {
            const num = i < 10 ? '0' + i : i;
            daysGrid.innerHTML += `
                <div class="w-8 h-8 rounded-full border border-gray-200 bg-white flex items-center justify-center text-[10px] font-bold text-gray-400 cursor-pointer hover:border-yellow-500 hover:text-yellow-600 transition-all">
                    ${num}
                </div>`;
        }

        // Generate 1-12
        for (let i = 1; i <= 12; i++) {
            const num = i < 10 ? '0' + i : i;
            monthsGrid.innerHTML += `
                <div class="w-8 h-8 rounded-full border border-gray-200 bg-white flex items-center justify-center text-[10px] font-bold text-gray-400 cursor-pointer hover:border-yellow-500 hover:text-yellow-600 transition-all">
                    ${num}
                </div>`;
        }
    }
    renderTicketNumbers();
