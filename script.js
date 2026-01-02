// --- Carousel Control ---
// let currentSlide = 0;
// const track = document.getElementById('carouselTrack');
// const slides = document.querySelectorAll('.carousel-slide');

// function moveCarousel() {
//     if(!track) return;
//     currentSlide = (currentSlide + 1) % slides.length;
//     track.style.transform = `translateX(-${currentSlide * 100}%)`;
// }
// setInterval(moveCarousel, 3000); // Change slide every 3 seconds

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
    {name:'Cash Splash', price:50, img:'https://images.unsplash.com/photo-1518458028434-541f068ff9b9?w=400'},
    {name:'House of Gold', price:20, img:'https://images.unsplash.com/photo-1610375461246-83df859d849d?w=400'},
    {name:'Wicket Win', price:10, img:'https://images.unsplash.com/photo-1531415074968-036ba1b575da?w=400'},
    {name:'Jungle Gem', price:5, img:'https://images.unsplash.com/photo-1544306094-e2daf9459aa4?w=400'},
    {name:'Mega Million', price:100, img:'https://images.unsplash.com/photo-1550565118-3d143c00368d?w=400'},
    {name:'Diamond 777', price:30, img:'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400'},
    {name:'Lucky Red', price:20, img:'https://images.unsplash.com/photo-1614028674026-a65e31bfd27c?w=400'},
    {name:'Silver Box', price:15, img:'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=400'},
    {name:'Royal Flush', price:50, img:'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?w=400'},
    {name:'Neon Win', price:25, img:'https://images.unsplash.com/photo-1605792657660-596af9039e23?w=400'},
    {name:'Game On', price:40, img:'https://images.unsplash.com/photo-1553481187-be93c21490a9?w=400'},
    {name:'Pixel Cash', price:10, img:'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=400'},
    {name:'Vortex', price:50, img:'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=400'},
    {name:'Office Win', price:20, img:'https://images.unsplash.com/photo-1454165833767-027ffea9e778?w=400'},
    {name:'Gold Rush', price:100, img:'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400'},
    {name:'Pocket Money', price:5, img:'https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?w=400'}
];

if(scratchGrid) {
    cardData.forEach(c => {
        scratchGrid.innerHTML += `
            <div class="card-wrapper rounded-[25px] overflow-hidden shadow-lg bg-white group cursor-pointer transition hover:-translate-y-2">
                <div class="scratch-img-box">
                    <img src="${c.img}">
                    <div class="card-info text-white"><span class="text-orange-500 font-black text-xs">AED ${c.price}</span><h4 class="text-xl font-black italic uppercase">${c.name}</h4></div>
                </div>
                <div class="bg-gray-900 text-white py-4 text-center text-[10px] font-black uppercase group-hover:bg-green-700 transition">Scratch Now</div>
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