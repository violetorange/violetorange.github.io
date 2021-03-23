Vue.createApp({
    data() {
        return {
            mainValue: "",
            isPressed: 'x',
            preloaderIsReady: false
        }
    },
    mounted() {
        this.preloader();
    },
    methods: {
        preloader() {
            setTimeout(() => {
                this.preloaderIsReady = true;
            }, 1000)
        },
        addSymbol(char) {
            this.mainValue = this.mainValue.toString();
            this.mainValue += char;
        },
        delSymbol() {
            this.mainValue = this.mainValue.toString().split('').slice(0, -1).join('');
        },
        equally() {
            this.mainValue = eval(this.mainValue);
            Number.isInteger(this.mainValue) ? this.mainValue : this.mainValue = parseFloat(this.mainValue.toPrecision(8));
        },
        reset() {
            this.mainValue = "";
        },
        startAnim() {
            
            if (this.isPressed == 'x') {
                this.isPressed = true;
            } else if (this.isPressed == true) {
                this.isPressed = false;
            } else if (this.isPressed == false) {
                this.isPressed = true;
            }
        }
    }
}).mount('#app')