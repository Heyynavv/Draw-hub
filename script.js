// --- Carousel Control ---


let currentSlide = 0;
const track = document.getElementById('carouselTrack');
const slides = document.querySelectorAll('.carousel-slide');
const dotsContainer = document.getElementById('carouselDots');

// Create Dots
slides.forEach((_, i) => {
    const dot = document.createElement('div');
    dot.className = `dot ${i === 0 ? 'active' : ''}`;
    dot.onclick = () => goToSlide(i);
    dotsContainer.appendChild(dot);
});

const dots = document.querySelectorAll('.dot');

function updateSlider() {
    track.style.transform = `translateX(-${currentSlide * 100}%)`;
    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === currentSlide);
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

// Auto Play every 5 seconds
let autoPlay = setInterval(nextSlide, 4000);

// Pause on Hover
document.querySelector('.carousel-container').addEventListener('mouseenter', () => clearInterval(autoPlay));
document.querySelector('.carousel-container').addEventListener('mouseleave', () => autoPlay = setInterval(nextSlide, 5000));

// --- Sidebar Control ---
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

const closeSidebar = () => {
    sidebar.classList.remove('sidebar-open');
    overlay.style.display = 'none';
}

if(closeBtn) closeBtn.onclick = closeSidebar;
if(overlay) overlay.onclick = closeSidebar;

// --- Jackpot Grid Generation ---
const jackGrid = document.getElementById('jackpot-grid');
if(jackGrid) {
    for(let i=1; i<=31; i++) {
        const val = i < 10 ? '0' + i : i;
        jackGrid.innerHTML += `<div class="w-8 h-8 md:w-10 md:h-10 rounded-full border border-gray-200 bg-white flex items-center justify-center text-[10px] font-bold text-gray-400 hover:bg-green-700 hover:text-white cursor-pointer transition">${val}</div>`;
    }
}

// --- Scratch Cards Generation (16 Cards) ---

const scratchGrid = document.getElementById('scratch-grid');

const cardData = [
    {name:'Cash Splash', price:50, win:'1,000,000', color:'bg-[#1b8c38]', img:'1550565118-3d143c00368d'},
    {name:'House of Gold', price:20, win:'300,000', color:'bg-[#c41e3a]', img:'1610375461246-83df859d849d'},
    {name:'Jungle Jewels', price:10, win:'100,000', color:'bg-[#0b4d2a]', img:'1502082553245-f0bc7a671450'},
    {name:'Wicket Win', price:5, win:'50,000', color:'bg-[#2b4c91]', img:'1531415074968-036ba1b575da'},
    {name:'Mega Million', price:100, win:'5,000,000', color:'bg-[#4c1a59]', img:'1518458028434-541f068ff9b9'},
    {name:'Diamond 777', price:30, win:'750,000', color:'bg-[#0e7490]', img:'1563013544-824ae1b704d3'},
    {name:'Lucky Red', price:20, win:'250,000', color:'bg-[#9f1239]', img:'1614028674026-a65e31bfd27c'},
    {name:'Silver Box', price:15, win:'150,000', color:'bg-[#475569]', img:'1579621970563-ebec7560ff3e'},
    {name:'Royal Flush', price:50, win:'1,200,000', color:'bg-[#312e81]', img:'1526304640581-d334cdbbf45e'},
    {name:'Neon Win', price:25, win:'200,000', color:'bg-[#be185d]', img:'1605792657660-596af9039e23'},
    {name:'Game On', price:40, win:'800,000', color:'bg-[#c2410c]', img:'1553481187-be93c21490a9'},
    {name:'Pixel Cash', price:10, win:'100,000', color:'bg-[#0e7490]', img:'1511512578047-dfb367046420'},
    {name:'Vortex', price:50, win:'1,500,000', color:'bg-[#4c1d95]', img:'1618005182384-a83a8bd57fbe'},
    {name:'Office Win', price:20, win:'300,000', color:'bg-[#065f46]', img:'1454165833767-027ffea9e778'},
    {name:'Gold Rush', price:100, win:'10,000,000', color:'bg-[#b45309]', img:'1460925895917-afdab827c52f'},
    {name:'Pocket Money', price:5, win:'25,000', color:'bg-[#0d9488]', img:'1590283603385-17ffb3a7f29f'}
];

if(scratchGrid) {
    scratchGrid.innerHTML = '';
    cardData.forEach(c => {
        scratchGrid.innerHTML += `
            <div class="group relative bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 cursor-pointer border border-slate-100">
                
                <div class="absolute top-3 right-3 z-20 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-lg shadow-sm border border-white/50 flex flex-col items-center">
                    <span class="text-[7px] font-black text-slate-400 leading-none uppercase">AED</span>
                    <span class="text-sm font-black text-slate-900 leading-none">${c.price}</span>
                </div>

                <div class="relative h-48 sm:h-56 lg:h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-${c.img}?auto=format&fit=crop&q=80&w=400" 
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
const ticker = document.getElementById('ticker-wrap');
if(ticker) {
    let tickerHTML = '';
    for(let i=0; i<15; i++) {
        tickerHTML += `<div class="ticker-item"><p class="text-[9px] font-black text-gray-400 uppercase">Winner Ref: ${Math.random().toString(36).substr(7).toUpperCase()}</p><p class="text-xl font-black text-green-700 italic">AED ${Math.floor(Math.random()*5000)}</p></div>`;
    }
    ticker.innerHTML = tickerHTML + tickerHTML;
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
    function updateTimers() {
        const now = new Date();

        // --- 1. INSTANT DRAW TIMER (Purple Card: 1 Minute Loop) ---
        const instantTimer = document.getElementById('instant-timer');
        if (instantTimer) {
            const secLeft = 59 - now.getSeconds();
            // Minute box hamesha 00 rahega ya tu total seconds bhi dikha sakta hai
            instantTimer.querySelector('.minutes').innerText = "00";
            instantTimer.querySelector('.seconds').innerText = secLeft < 10 ? "0" + secLeft : secLeft;
        }

        // --- 2. DAILY DRAW TIMER (Pick 3 & Pick 4) ---
        // Maan lo draw roz raat 12 baje hota hai
        const nextDraw = new Date();
        nextDraw.setHours(24, 0, 0, 0); 

        const diff = nextDraw - now;

        const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
        const m = Math.floor((diff / (1000 * 60)) % 60);
        const s = Math.floor((diff / 1000) % 60);

        const timeStr = {
            h: h < 10 ? "0" + h : h,
            m: m < 10 ? "0" + m : m,
            s: s < 10 ? "0" + s : s
        };

        // Update Pick 3
        const p3 = document.getElementById('pick3-timer');
        if (p3) {
            p3.querySelector('.hours').innerText = timeStr.h;
            p3.querySelector('.minutes').innerText = timeStr.m;
            p3.querySelector('.seconds').innerText = timeStr.s;
        }

        // Update Pick 4
        const p4 = document.getElementById('pick4-timer');
        if (p4) {
            p4.querySelector('.hours').innerText = timeStr.h;
            p4.querySelector('.minutes').innerText = timeStr.m;
            p4.querySelector('.seconds').innerText = timeStr.s;
        }
    }

    // Har second update karo
    setInterval(updateTimers, 1000);
    // Pehli baar turant chalao taaki 00 na dikhe
    updateTimers();
}

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
