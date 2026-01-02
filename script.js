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

// const scratchGrid = document.getElementById('scratch-grid');
// const cardData = [
//     {name:'Cash Splash', price:50, img:'https://images.unsplash.com/photo-1518458028434-541f068ff9b9?w=400'},
//     {name:'House of Gold', price:20, img:'https://images.unsplash.com/photo-1610375461246-83df859d849d?w=400'},
//     {name:'Wicket Win', price:10, img:'https://images.unsplash.com/photo-1531415074968-036ba1b575da?w=400'},
//     {name:'Jungle Gem', price:5, img:'https://images.unsplash.com/photo-1544306094-e2daf9459aa4?w=400'},
//     {name:'Mega Million', price:100, img:'https://images.unsplash.com/photo-1550565118-3d143c00368d?w=400'},
//     {name:'Diamond 777', price:30, img:'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400'},
//     {name:'Lucky Red', price:20, img:'https://images.unsplash.com/photo-1614028674026-a65e31bfd27c?w=400'},
//     {name:'Silver Box', price:15, img:'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=400'},
//     {name:'Royal Flush', price:50, img:'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?w=400'},
//     {name:'Neon Win', price:25, img:'https://images.unsplash.com/photo-1605792657660-596af9039e23?w=400'},
//     {name:'Game On', price:40, img:'https://images.unsplash.com/photo-1553481187-be93c21490a9?w=400'},
//     {name:'Pixel Cash', price:10, img:'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=400'},
//     {name:'Vortex', price:50, img:'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=400'},
//     {name:'Office Win', price:20, img:'https://images.unsplash.com/photo-1454165833767-027ffea9e778?w=400'},
//     {name:'Gold Rush', price:100, img:'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400'},
//     {name:'Pocket Money', price:5, img:'https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?w=400'}
// ];

// if(scratchGrid) {
//     cardData.forEach(c => {
//         scratchGrid.innerHTML += `
//             <div class="card-wrapper rounded-[25px] overflow-hidden shadow-lg bg-white group cursor-pointer transition hover:-translate-y-2">
//                 <div class="scratch-img-box">
//                     <img src="${c.img}">
//                     <div class="card-info text-white"><span class="text-orange-500 font-black text-xs">AED ${c.price}</span><h4 class="text-xl font-black italic uppercase">${c.name}</h4></div>
//                 </div>
//                 <div class="bg-gray-900 text-white py-4 text-center text-[10px] font-black uppercase group-hover:bg-green-700 transition">Scratch Now</div>
//             </div>
//         `;
//     });
// }

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
            <div class="group relative bg-white rounded-[2.5rem] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.1)] hover:shadow-[0_30px_60px_rgba(0,0,0,0.2)] transition-all duration-500 hover:-translate-y-4 cursor-pointer border border-white">
                
                <div class="absolute top-5 left-5 z-20 backdrop-blur-md bg-green-500/80 text-white text-[10px] font-black px-3 py-1 rounded-lg italic tracking-widest shadow-lg">
                    NEW
                </div>

                <div class="absolute top-5 right-5 z-20 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-2xl shadow-sm border border-white/50 flex flex-col items-center">
                    <span class="text-[8px] font-black text-slate-400 leading-none">AED</span>
                    <span class="text-lg font-black text-slate-900 leading-none">${c.price}</span>
                </div>

                <div class="relative h-64 md:h-80 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-${c.img}?auto=format&fit=crop&q=80&w=400&h=600" 
                         class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                    
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 scale-50 group-hover:scale-100">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-xl border border-white/30 rounded-full flex items-center justify-center shadow-2xl">
                            <div class="w-0 h-0 border-t-[10px] border-t-transparent border-l-[18px] border-l-white border-b-[10px] border-b-transparent ml-1"></div>
                        </div>
                    </div>

                    <div class="absolute bottom-8 left-0 right-0 px-6 text-center">
                        <h4 class="text-white text-2xl font-black uppercase italic tracking-tighter drop-shadow-2xl mb-2">
                            ${c.name}
                        </h4>
                        <div class="w-10 h-1.5 bg-yellow-400 mx-auto rounded-full transition-all duration-500 group-hover:w-28 shadow-[0_0_15px_rgba(250,204,21,0.6)]"></div>
                    </div>
                </div>

                <div class="${c.color} py-5 px-2 text-center relative overflow-hidden">
                    <div class="absolute top-0 -left-full w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent transition-all duration-1000 group-hover:left-full"></div>
                    
                    <p class="text-[10px] font-bold text-white/60 uppercase tracking-widest mb-1">Top Prize</p>
                    <p class="text-xl md:text-2xl font-black text-white italic tracking-tighter drop-shadow-md">
                        WIN AED ${c.win}
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
