<template>
    <div class="activity-wheel-container">
        <div class="wheel-actions">
            <button :disabled="isSpinning" @click="startSpin()" class="btn btn-outline-primary btn-lg">SPIN THE WHEEL</button>
        </div>
        <transition name="bounce">
            <div v-if="winnerText" class="alert alert-success">
                {{ winnerText }}
                {{ winnerDescription }}
            </div>
        </transition>
        <div class="wheels-container">
            <div class="wheels">
                <div class="wheel-container">
                    <canvas ref="mainWheel" class="wheel-main"></canvas>
                </div>
                <div class="wheel-container">
                    <canvas ref="innerWheel" class="wheel-sub"></canvas>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export const getRandomInt = (min, max) => {
        min = Math.ceil(min)
        max = Math.floor(max)
        return Math.floor(Math.random() * (max - min)) + min
    };

    function isAngleBetween(angle, lower, upper) {
        lower %= 2 * Math.PI;
        upper %= 2 * Math.PI;
        if (lower <= upper) {
            return lower < angle && upper >= angle
        } else {
            return lower < angle || upper >= angle
        }
    }

    /**
     * Draw inner wheel with activities
     */
    function drawWheel(canvas, angle, activities) {
        const r = Math.min(canvas.width, canvas.height) / 2.05
        const cx = canvas.width / 2
        const cy = canvas.height / 2
        const ctx = canvas.getContext('2d')

        ctx.clearRect(0, 0, canvas.width, canvas.height)
        let g = ctx.createRadialGradient(cx, cy, 0, cx, cy, r)

        g.addColorStop(0, 'rgba(0,0,0,0)');
        g.addColorStop(1, 'rgba(0,0,0,0.1)');

        const totalFreq = activities.length
        let cumulative = 0
        let winner = -1

        for (let i = 0; i < activities.length; ++i) {
            const activity = activities[i]
            const freq = 1
            cumulative += freq

            const arcAngle1 = angle + (2 * Math.PI * (cumulative - freq)) / totalFreq
            const arcAngle2 = angle + (2 * Math.PI * cumulative) / totalFreq

            const textAngle = angle + (2 * Math.PI * (cumulative - freq / 2)) / totalFreq
            const highlight = false // helper function to calculate

            /**
             * Draw arcs
             */
            ctx.beginPath()
            ctx.moveTo(cx, cy)
            ctx.arc(cx, cy, r, arcAngle1, arcAngle2, false)
            ctx.fillStyle = activities[i].color
            ctx.fill()
            ctx.fillStyle = g
            ctx.fill()
            ctx.save()

            /**
             * Draw text
             */

            const angleModifier = Math.min(arcAngle1 - arcAngle2, 0.25)
            const lengthModifier = 1 - Math.round(activity.name.length / 3) * 0.07
            const fontModifier = 1
            const fontSize = Math.max(20, 0.4 * r * angleModifier * lengthModifier * fontModifier)

            ctx.fillStyle = '#000'
            ctx.font = `${fontSize}px Arial, sans-serif `
            ctx.textAlign = 'right'
            ctx.textBaseline = 'middle'
            ctx.translate(cx, cy)
            ctx.rotate(textAngle)
            ctx.fillText(activity.name, r * 0.91, 0)
            ctx.restore()
        }
    }

    /**
     * Draw the wheel
     */
    function redrawFrame(canvas) {
        const r = Math.min(canvas.width, canvas.height) / 2.05
        const cx = canvas.width / 2
        const cy = canvas.height / 2
        const ctx = canvas.getContext('2d')

        /**
         * Outer Ring
         */

        ctx.save()
        ctx.shadowOffsetX = r / 100;
        ctx.shadowOffsetY = r / 100;
        ctx.shadowBlur = r / 40;
        ctx.shadowColor = 'rgba(0,0,0,0.2)';
        ctx.beginPath();
        ctx.arc(cx, cy, r * 1.005, 0, 2 * Math.PI, true);
        ctx.arc(cx, cy, r * 0.985, 0, 2 * Math.PI, false);
        ctx.fillStyle = '#424242';
        ctx.fill();

        // center ring
        ctx.shadowOffsetX = r / 100;
        ctx.shadowOffsetY = r / 100;
        ctx.fillStyle = '#424242';
        ctx.beginPath();
        ctx.arc(cx, cy, r / 30, 0, 2 * Math.PI, false);
        ctx.fill();
        // prize pointer
        ctx.translate(cx, cy);
        ctx.rotate(Math.PI / 2);
        ctx.beginPath();
        ctx.moveTo(-r * 1.01, -r * 0.05);
        ctx.lineTo(-r * 0.935, 0);
        ctx.lineTo(-r * 1.01, r * 0.05);
        ctx.fillStyle = '#000';
        ctx.fill();
        ctx.restore();
    }

    function getResult(angle, activities) {
        const totalFreqs = activities.length
        let cumulative = 0
        let winner = -1

        for (let i = 0; i < activities.length; i++) {
            const freq = 1
            cumulative += freq;
            const arcAngle1 = angle + (2 * Math.PI * (cumulative - freq)) / totalFreqs
            const arcAngle2 = angle + (2 * Math.PI * cumulative) / totalFreqs
            if (isAngleBetween((3 / 2) * Math.PI, arcAngle1, arcAngle2)) {
                winner = i;
            }
        }

        return winner
    }

    export default {
        props: {
            activities: {
                type: Array,
                default: () => ([
                    {name: 'Schwimmen', color: '#BCE9FF'},
                    {name: 'Fußball spielen', color: '#BCFFDB'},
                    {name: 'Netflix', color: '#FFBCBF'},
                    {name: 'Zocken', color: '#E4FFBC'},
                    {name: 'Lesen', color: '#FFD2BC'},
                ])
            }
        },
        data: () => ({
            angle: 0,
            winnerText: '',
            winnerDescription: '',
            isSpinning: false,
        }),
        mounted() {
            this.resizeIntervalId = setInterval(this.resize, 10);
        },
        beforeDestroy() {
            clearInterval(this.resizeIntervalId);
        },
        methods: {
            /**
             * Start spinning the wheel
             */
            startSpin() {
                this.isSpinning = true
                this.winnerText = '';
                const mainCanvas = this.$refs.mainWheel
                const activities = this.activities
                const totalTicks = getRandomInt(450, 530) //450
                const speed = 0.12 + getRandomInt(0, 80) * 0.001 //0.12
                const start = +new Date()

                let currentTicks = 0

                const mainLoop = () => {
                    const now = +new Date()
                    const targetTicks = Math.min(totalTicks, (now - start) / 10)

                    for (; currentTicks <= targetTicks; ++currentTicks) {
                        this.angle += (speed * (totalTicks - currentTicks)) / totalTicks
                    }

                    drawWheel(mainCanvas, this.angle, activities)

                    if (currentTicks < totalTicks) {
                        window.requestAnimationFrame(mainLoop)
                    } else {
                        this.spinComplete()
                    }
                }

                window.requestAnimationFrame(mainLoop)
            },

            spinComplete() {
                this.isSpinning = false;
                const winnerIndex = getResult(this.angle, this.activities);
                if (this.activities[winnerIndex].description) {
                    this.winnerDescription = this.activities[winnerIndex].description
                }
                this.winnerText = this.activities[winnerIndex].name
            },

            resize() {
                const mainCanvas = this.$refs.mainWheel;
                const subCanvas = this.$refs.innerWheel;
                const pixelRatio = window.devicePixelRatio || 1;
                const desiredWidth = mainCanvas.offsetWidth * pixelRatio;
                const desiredHeight = mainCanvas.offsetHeight * pixelRatio;
                if (mainCanvas.width !== desiredWidth || mainCanvas.height !== desiredHeight) {
                    mainCanvas.width = desiredWidth;
                    mainCanvas.height = desiredHeight;
                    subCanvas.width = desiredWidth;
                    subCanvas.height = desiredHeight;
                    window.requestAnimationFrame(() => {
                        drawWheel(mainCanvas, this.angle, this.activities);
                        redrawFrame(subCanvas);
                    });
                }
            }
        }
    }
</script>

<style lang="scss">
    .wheel-actions {
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .wheels-container {
        position: relative;
        flex: 1 1 auto;
        height: 600px;
        max-height: 100%;
        max-width: 100%;
        overflow: hidden;
    }

    .wheels {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        max-height: 100%;
        max-width: 100%;
        overflow: hidden;
    }

    .wheel-container {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    .wheel-main,
    .wheel-sub {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        max-height: 100%;
        max-width: 100%;
        overflow: hidden;
    }

    .wheel-sub {
        z-index: 2;
    }

    .activity-wheel-container {
        display: flex;
        flex-direction: column;
    }

    .bounce-enter-active {
        animation: bounce-in .5s;
    }

    .bounce-leave-active {
        animation: bounce-in .5s reverse;
    }

    @keyframes bounce-in {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(1);
        }
    }
</style>
