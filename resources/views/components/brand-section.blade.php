@props(['brands' => [
    ['logo' => 'https://dummyimage.com/120x60/ccc/000&text=Marca+1', 'name' => 'Marca 1'],
    ['logo' => 'https://dummyimage.com/120x60/eee/333&text=Marca+2', 'name' => 'Marca 2'],
    ['logo' => 'https://dummyimage.com/120x60/ddd/111&text=Marca+3', 'name' => 'Marca 3'],
    ['logo' => 'https://dummyimage.com/120x60/bbb/fff&text=Marca+4', 'name' => 'Marca 4'],
]] )

<div class="brand-section-modern">
    <h2 class="brand-section-modern__title">Nuestras Marcas</h2>
    <div
        x-data="sliderAutoScroll()"
        x-init="init()"
        class="brand-section-modern__slider-viewport"
        @mouseenter="pause()" @mouseleave="play()"
    >
        <div class="brand-section-modern__slider-track" x-ref="track">
            <template x-for="(brand, idx) in brandsDoubled" :key="idx">
                <div class="brand-section-modern__item">
                    <div class="brand-section-modern__img-wrapper">
                        <img :src="brand.logo" :alt="brand.name" class="brand-section-modern__img" />
                    </div>
                    <span class="brand-section-modern__name" x-text="brand.name"></span>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
function sliderAutoScroll() {
    return {
        brands: @js($brands),
        brandsDoubled: [],
        interval: null,
        track: null,
        speed: 1.2,
        init() {
            this.track = this.$refs.track;
            // Duplica el array para efecto infinito
            this.brandsDoubled = [...this.brands, ...this.brands];
            this.play();
        },
        play() {
            this.pause();
            this.interval = setInterval(() => {
                this.track.scrollLeft += this.speed;
                // Reset para loop infinito
                if (this.track.scrollLeft >= this.track.scrollWidth / 2) {
                    this.track.scrollLeft = 0;
                }
            }, 16);
        },
        pause() {
            if (this.interval) clearInterval(this.interval);
        }
    }
}
</script>


    <div
        x-data="{
            scroll: null,
            interval: null,
            startScrolling() {
                console.log('AlpineJS startScrolling ejecutado', this.scroll, this.scroll ? this.scroll.scrollWidth : null, this.scroll ? this.scroll.offsetWidth : null);

                // Inicia scroll SIEMPRE para forzar el movimiento
                this.interval = setInterval(() => {
                    if (!this.scroll) return;
                    this.scroll.scrollLeft += 0.7;
                    console.log('tick', this.scroll, this.scroll.scrollLeft);
                    if (this.scroll.scrollLeft >= (this.scroll.scrollWidth / 2)) {
                        this.scroll.scrollLeft = 0;
                    }
                }, 16);
            },
            stopScrolling() {
                clearInterval(this.interval);
            }
        }"
        x-ref="slider"
        x-init="$nextTick(() => { scroll = $refs.slider; startScrolling(); })"
        @mouseenter="stopScrolling()" @mouseleave="startScrolling()"
        class="brand-section__slider-wrapper" style="width: 100%; overflow-x: auto;"
    >
        <div
            class="brand-section__slider"
            style="display: flex; gap: 2rem; align-items: center; width: max-content; white-space: nowrap;"
        >
            @foreach (array_merge($brands, $brands, $brands, $brands) as $brand)
                <div class="brand-section__item">
                    <div class="brand-section__img-wrapper">
                        <img src="{{ is_array($brand) ? ($brand['logo'] ?? $brand['name']) : $brand }}" alt="{{ is_array($brand) ? ($brand['name'] ?? 'Marca') : $brand }}" class="brand-section__img" />
                    </div>
                    <span class="brand-section__name">{{ is_array($brand) ? ($brand['name'] ?? 'Marca') : $brand }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
<style>
    .brand-section__slider::-webkit-scrollbar {
        display: none;
    }
</style>
