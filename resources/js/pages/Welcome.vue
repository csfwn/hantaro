<template>
  <div id="app">
    <!-- NAV -->
    <nav>
      <div class="logo">Hantaro<span>•</span></div>
      <div class="nav-mid">
        <a href="#features">Features</a>
        <a href="#hiw">How It Works</a>
        <a href="#pricing">Pricing</a>
        <a href="#faq">FAQ</a>
      </div>
      <div class="nav-right">
        <a href="/admin" class="nav-login">Log In</a>
        <a href="/admin/register" class="btn-orange">Get Started Free</a>
      </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
      <div class="hero-mesh"></div>
      <div class="hero-inner">
        <div style="margin-top: 50px;"></div>
        <h1>One Link.<br />Start Your <span class="accent">Business</span><br /><span class="accent">You Create.</span></h1>
        <p>Share your personal page, sell digital &amp; physical products, and grow your audience all from a single link like hantaro.my/yourname.</p>
        <div class="hero-btns">
          <a href="/admin/register" class="btn-orange" style="padding:13px 28px;font-size:.95rem;border-radius:10px">Claim your Hantaro free</a>
          <a href="#hiw" class="btn-outline-w">See how it works</a>
        </div>

        <!-- PHONES -->
        <div class="phone-row">
          <!-- Side Phone Left -->
          <div class="phone side">
            <div class="phone-notch"></div>
            <div class="phone-screen">
              <div class="pp-banner" style="background-image:url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=400&q=80')"></div>
              <div class="pp-body">
                <div class="pp-avatar-row">
                  <div class="pp-avatar"><img src="https://images.unsplash.com/photo-1499996860823-5214fcc65f8f?w=100&q=80" alt="" /></div>
                </div>
                <div class="pp-name">Roasted Co.</div>
                <div class="pp-handle">hantaro.my/roastedco</div>
                <div class="pp-items">
                  <div class="pp-item">
                    <div class="pp-item-thumb" style="background-image:url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=100&q=80')"></div>
                    <div class="pp-item-info">
                      <div class="pp-item-name">Liberica Blend</div>
                      <div class="pp-item-sub">250g · Coffee</div>
                    </div>
                    <div class="pp-item-right">
                      <div class="pp-item-price">RM42</div>
                      <div class="pp-item-btn">Buy</div>
                    </div>
                  </div>
                  <div class="pp-item">
                    <div class="pp-item-thumb" style="background-image:url('https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=100&q=80')"></div>
                    <div class="pp-item-info">
                      <div class="pp-item-name">Robusta Dark</div>
                      <div class="pp-item-sub">250g · Coffee</div>
                    </div>
                    <div class="pp-item-right">
                      <div class="pp-item-price">RM35</div>
                      <div class="pp-item-btn">Buy</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Center Phone -->
          <div class="phone">
            <div class="phone-notch"></div>
            <div class="phone-screen">
              <div class="pp-banner" style="background:linear-gradient(135deg,#F57C20,#d96a15)"></div>
              <div class="pp-body">
                <div class="pp-avatar-row">
                  <div class="pp-avatar"><img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=100&q=80" alt="" /></div>
                </div>
                <div class="pp-name">Aina Sofea ✨</div>
                <div class="pp-handle">hantaro.my/ainasofea</div>
                <div class="pp-socials">
                  <div class="pp-soc">📸</div>
                  <div class="pp-soc">💬</div>
                  <div class="pp-soc">🎵</div>
                </div>
                <div class="pp-items">
                  <div class="pp-item">
                    <div class="pp-item-thumb" style="background-image:url('https://images.unsplash.com/photo-1553361371-9b22f78e8b1d?w=100&q=80')"></div>
                    <div class="pp-item-info">
                      <div class="pp-item-name">Preset Pack Vol.1</div>
                      <div class="pp-item-sub">Digital Download</div>
                    </div>
                    <div class="pp-item-right">
                      <div class="pp-item-price">RM25</div>
                      <div class="pp-item-btn">Buy</div>
                    </div>
                  </div>
                  <div class="pp-item">
                    <div class="pp-item-thumb" style="background-image:url('https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=100&q=80')"></div>
                    <div class="pp-item-info">
                      <div class="pp-item-name">Content Planner PDF</div>
                      <div class="pp-item-sub">Digital · Instant</div>
                    </div>
                    <div class="pp-item-right">
                      <div class="pp-item-price">RM18</div>
                      <div class="pp-item-btn">Buy</div>
                    </div>
                  </div>
                  <div class="pp-item">
                    <div class="pp-item-thumb" style="background-image:url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=100&q=80')"></div>
                    <div class="pp-item-info">
                      <div class="pp-item-name">Kek Lapis Order</div>
                      <div class="pp-item-sub">Physical · 3 days</div>
                    </div>
                    <div class="pp-item-right">
                      <div class="pp-item-price">RM39</div>
                      <div class="pp-item-btn">Buy</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Side Phone Right -->
          <div class="phone side">
            <div class="phone-notch"></div>
            <div class="phone-screen">
              <div class="pp-banner" style="background-image:url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=80')"></div>
              <div class="pp-body">
                <div class="pp-avatar-row">
                  <div class="pp-avatar"><img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=100&q=80" alt="" /></div>
                </div>
                <div class="pp-name">Batik Craft</div>
                <div class="pp-handle">hantaro.my/batikcraft</div>
                <div class="pp-items">
                  <div class="pp-item">
                    <div class="pp-item-thumb" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWVrFrWQoj64rtaf5cYN7abLrJWv3sKqG4NA&s')"></div>
                    <div class="pp-item-info">
                      <div class="pp-item-name">Sarung Batik</div>
                      <div class="pp-item-sub">Handmade</div>
                    </div>
                    <div class="pp-item-right">
                      <div class="pp-item-price">RM85</div>
                      <div class="pp-item-btn">Buy</div>
                    </div>
                  </div>
                  <div class="pp-item">
                    <div class="pp-item-thumb" style="background-image:url('https://media-cdn.tripadvisor.com/media/photo-s/0f/3f/be/72/silk-scarf-3.jpg')"></div>
                    <div class="pp-item-info">
                      <div class="pp-item-name">Scarf Batik</div>
                      <div class="pp-item-sub">Handmade</div>
                    </div>
                    <div class="pp-item-right">
                      <div class="pp-item-price">RM55</div>
                      <div class="pp-item-btn">Buy</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- MARQUEE -->
    <div class="marquee-bar">
      <div class="marquee-track">
        <div v-for="(item, i) in [...marqueeItems, ...marqueeItems]" :key="i" class="marquee-item">
          {{ item }} <span class="m-dot"></span>
        </div>
      </div>
    </div>

    <!-- STATS -->
    <div class="stats">
      <div class="stats-grid">
        <div v-for="stat in stats" :key="stat.label" class="stat">
          <div class="stat-n" v-html="stat.number"></div>
          <div class="stat-d">{{ stat.label }}</div>
        </div>
      </div>
    </div>

    <!-- SHOWCASE 1 -->
    <section class="showcase">
      <div class="showcase-inner">
        <div>
          <span class="sec-label">For food &amp; product sellers</span>
          <h2 class="sec-title">Your products, sold beautifully online</h2>
          <p class="sec-sub">List physical items food, fashion, crafts and let customers order directly. WhatsApp notification on every order.</p>
          <div class="checklist">
            <div v-for="item in showcase1Checks" :key="item.text" class="check-item">
              <div class="check-icon">{{ item.icon }}</div>
              <span class="check-text">{{ item.text }}</span>
            </div>
          </div>
        </div>
        <div class="c-card">
          <div class="c-banner" style="background-image:url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&q=80')"></div>
          <div class="c-body">
            <div class="c-top-row">
              <div class="c-avatar"><img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=100&q=80" alt="" /></div>
              <div class="c-link-pill">hantaro.my/kektradisi</div>
            </div>
            <div class="c-name">Puan Zila's Kitchen</div>
            <div class="c-handle">@kektradisi · Kuala Lumpur 🇲🇾</div>
            <div class="c-bio">Homemade traditional Malay kuih &amp; cakes. Order 3 days ahead. All handmade with love 🍰</div>
            <div class="c-products">
              <div v-for="prod in showcase1Products" :key="prod.name" class="c-prod">
                <div class="c-prod-img" :style="{ backgroundImage: `url('${prod.img}')` }"></div>
                <div class="c-prod-info">
                  <div class="c-prod-name">{{ prod.name }}</div>
                  <div class="c-prod-sub">{{ prod.sub }}</div>
                </div>
                <div class="c-prod-price">{{ prod.price }}</div>
                <button class="c-prod-btn">Order</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SHOWCASE 2 -->
    <section class="showcase" style="background:#f9f9f9;border-top:1px solid #e5e7eb;border-bottom:1px solid #e5e7eb">
      <div class="showcase-inner">
        <div class="c-card">
          <div class="c-banner" style="background-image:url('https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=600&q=80')"></div>
          <div class="c-body">
            <div class="c-top-row">
              <div class="c-avatar"><img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=100&q=80" alt="" /></div>
              <div class="c-link-pill">hantaro.my/aina.creates</div>
            </div>
            <div class="c-name">Aina Sofea</div>
            <div class="c-handle">@aina.creates · Content Creator</div>
            <div class="c-bio">Photography tips, content templates &amp; digital goodies. Download my resources 👇</div>
            <div class="c-products">
              <div v-for="prod in showcase2Products" :key="prod.name" class="c-prod">
                <div class="c-prod-img" :style="{ backgroundImage: `url('${prod.img}')` }"></div>
                <div class="c-prod-info">
                  <div class="c-prod-name">{{ prod.name }}</div>
                  <div class="c-prod-sub">{{ prod.sub }}</div>
                </div>
                <div class="c-prod-price">{{ prod.price }}</div>
                <button class="c-prod-btn">Buy</button>
              </div>
            </div>
          </div>
        </div>
        <div>
          <span class="sec-label">For digital creators</span>
          <h2 class="sec-title">Sell what you create digitally</h2>
          <p class="sec-sub">Sell ebooks, presets, templates, courses buyers get an instant download link after payment. Pure passive income.</p>
          <div class="checklist">
            <div v-for="item in showcase2Checks" :key="item.text" class="check-item">
              <div class="check-icon">{{ item.icon }}</div>
              <span class="check-text">{{ item.text }}</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURES -->
    <section id="features" class="features">
      <div class="features-inner">
        <div class="features-head">
          <span class="sec-label">Platform features</span>
          <h2 class="sec-title">Everything a creator needs</h2>
          <p class="sec-sub">Built for Malaysian creators, influencers &amp; home businesses no technical skills required.</p>
        </div>
        <div class="feat-grid">
          <div v-for="feat in features" :key="feat.title" class="feat-item">
            <div class="feat-ico">{{ feat.icon }}</div>
            <div class="feat-title">{{ feat.title }}</div>
            <div class="feat-desc">{{ feat.desc }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="hiw" class="hiw">
      <div class="hiw-inner">
        <div class="hiw-head">
          <span class="sec-label">Simple setup</span>
          <h2 class="sec-title">Live in 3 steps</h2>
          <p class="sec-sub">No code, no designers, no drama. Start selling in minutes.</p>
        </div>
        <div class="steps">
          <div v-for="(step, i) in steps" :key="step.title" class="step">
            <div class="step-num">{{ i + 1 }}</div>
            <div class="step-title">{{ step.title }}</div>
            <p class="step-desc">{{ step.desc }}</p>
            <div v-if="step.url" class="step-url">{{ step.url }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- PRICING -->
    <section id="pricing" class="pricing">
      <div class="pricing-head">
        <span class="sec-label">Pricing</span>
        <h2 class="sec-title">Simple, transparent pricing</h2>
        <p class="sec-sub">Start free, upgrade as you grow — no hidden fees.</p>
      </div>
      <div class="plans">
        <div
          v-for="plan in plans"
          :key="plan.name"
          class="plan"
          :class="{ pop: plan.popular }"
        >
          <div v-if="plan.popular" class="plan-badge">Most Popular</div>
          <div class="plan-name">{{ plan.name }}</div>
          <div class="plan-price" v-html="plan.price"></div>
          <div class="plan-period">{{ plan.period }}</div>
          <ul class="plan-feats">
            <li v-for="feat in plan.features" :key="feat">{{ feat }}</li>
          </ul>
          <button class="plan-btn" :class="plan.btnClass" @click="handlePlanClick(plan)">{{ plan.btnLabel }}</button>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="faq">
      <div class="faq-inner">
        <div class="faq-head">
          <span class="sec-label">FAQ</span>
          <h2 class="sec-title">Frequently asked questions</h2>
        </div>
        <div class="faq-list">
          <details v-for="faq in faqs" :key="faq.q">
            <summary>{{ faq.q }} <div class="faq-plus">+</div></summary>
            <p class="faq-ans">{{ faq.a }}</p>
          </details>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="cta">
      <div class="cta-inner">
        <span class="sec-label">Join 10,000+ creators</span>
        <h2 class="sec-title" style="color:#fff;margin-bottom:10px">Your link is waiting.<br /><span style="color:#F57C20">Claim it free.</span></h2>
        <p style="color:#555;font-size:.9rem;margin-top:10px">No credit card. No setup fee. Live in minutes.</p>
        <div class="cta-row">
          <input v-model="ctaEmail" class="cta-input" type="email" placeholder="Enter your email address" />
          <button class="btn-orange" style="padding:13px 24px;font-size:.875rem;border-radius:10px" @click="handleCtaSubmit">Get Started Free</button>
        </div>
        <p class="cta-note">Free forever plan available · Setup in 5 minutes · No code needed</p>
      </div>
    </section>

    <!-- FOOTER -->
    <footer>
      <p>© 2026 Stwo Ventures Sdn Bhd. 202503084987 (AS0493179-P).</p>
      <div class="foot-links">
        <a href="/privacy">Privacy</a>
        <a href="/terms">Terms</a>
        <a href="/contact">Contact</a>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'HantaroLanding',

  data() {
    return {
      ctaEmail: '',

      marqueeItems: [
        'Digital Products',
        'Physical Products',
        'Personal Link Page',
        'WhatsApp Orders',
        'Instant Download',
        'No Tech Skills',
        'DuitNow & FPX',
      ],

      stats: [
        { number: '10k<span>+</span>', label: 'Creators & sellers on Hantaro' },
        { number: '4.9<span>⭐</span>', label: 'Average creator rating' },
        { number: '100<span>%</span>', label: 'Mobile-optimized experience' },
      ],

      showcase1Checks: [
        { icon: '📦', text: 'Add unlimited products with photos, variants & stock tracking' },
        { icon: '💬', text: 'Instant WhatsApp order alerts works without any app' },
        { icon: '💳', text: 'FPX, DuitNow QR & manual bank transfer supported' },
      ],

      showcase1Products: [
        {
          name: 'Kek Coklat Moist',
          sub: 'Whole Cake · 1kg',
          price: 'RM39',
          img: 'https://cdn.motherhood.com.my/wp-content/uploads/sites/2/2023/05/05135830/Copy-of-Story-MMY-8-1-1-1.png',
        },
        {
          name: 'Akok Traditional',
          sub: 'Set of 12',
          price: 'RM15',
          img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVvj0BE-y_K2nu8beNyL6mPUyBKmDqi4FQcQ&s',
        },
      ],

      showcase2Checks: [
        { icon: '⚡', text: 'Instant auto-delivery of files after payment' },
        { icon: '🔗', text: 'One page for all your links, products & socials' },
        { icon: '📊', text: 'Track views, clicks & earnings in real-time' },
      ],

      showcase2Products: [
        {
          name: 'Lightroom Preset Pack',
          sub: 'Digital · 30 Presets',
          price: 'RM25',
          img: 'https://images.unsplash.com/photo-1553361371-9b22f78e8b1d?w=100&q=80',
        },
        {
          name: '30-Day Content Planner',
          sub: 'PDF · Instant Access',
          price: 'RM18',
          img: 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=100&q=80',
        },
      ],

      features: [
        { icon: '🔗', title: 'Personal Link Page', desc: 'Your own hantaro.my/yourname — like Linktree but with a built-in store and checkout.' },
        { icon: '📦', title: 'Physical Products', desc: 'List food, fashion, crafts with photos, stock count, variants and delivery options.' },
        { icon: '⚡', title: 'Digital Products', desc: 'Sell ebooks, presets, templates, courses — buyers get instant download after payment.' },
        { icon: '💳', title: 'Flexible Payments', desc: 'FPX online banking, DuitNow QR, or manual bank transfer — accept money your way.' },
        { icon: '💬', title: 'WhatsApp Integration', desc: 'Get instant order notifications on WhatsApp. Customers can reach you in one tap.' },
        { icon: '📊', title: 'Creator Dashboard', desc: 'Real-time analytics: page views, link clicks, sales and top products — all in one view.' },
      ],

      steps: [
        {
          title: 'Claim Your Link',
          desc: 'Sign up free and choose your unique URL. Your page goes live instantly.',
          url: 'hantaro.my/yourname',
        },
        {
          title: 'Add Your Products',
          desc: 'Upload digital files or product photos. Set prices and descriptions — done in minutes.',
          url: null,
        },
        {
          title: 'Share & Earn',
          desc: 'Drop your link on Instagram bio, WhatsApp status, TikTok and start collecting orders.',
          url: null,
        },
      ],

      plans: [
        {
          name: 'Starter',
          price: 'RM0',
          period: 'forever free',
          popular: false,
          btnClass: 'outline',
          btnLabel: 'Get Started Free',
          features: [
            'Personal link page',
            'Up to 10 products',
            'Physical & digital products',
            'WhatsApp order alerts',
            '2.5%–3% platform fee',
          ],
        },
        {
          name: 'Creator',
          price: 'RM49<sub>/mo</sub>',
          period: 'billed monthly',
          popular: true,
          btnClass: 'solid',
          btnLabel: 'Upgrade to Creator',
          features: [
            'Everything in Starter',
            'Unlimited products',
            'Custom page themes',
            'Analytics dashboard',
            'Priority support',
            'Lower 1.5% platform fee',
          ],
        },
        {
          name: 'Pro',
          price: 'RM129<sub>/mo</sub>',
          period: 'billed monthly',
          popular: false,
          btnClass: 'outline',
          btnLabel: 'Upgrade to Pro',
          features: [
            'Everything in Creator',
            'Multiple stores & brands',
            'Team access & staff roles',
            'Advanced reports & CSV',
            'Marketplace sync',
            '0% platform fee',
          ],
        },
      ],

      faqs: [
        {
          q: "What's the difference between Hantaro and Linktree?",
          a: 'Linktree only gives you links. Hantaro gives you a full store — customers can browse and buy directly from your page. You also get order management, payment processing, and WhatsApp notifications built in.',
        },
        {
          q: 'Can I sell digital products like ebooks and presets?',
          a: 'Yes! When a customer pays, they automatically receive a download link. No manual sending — it works while you sleep.',
        },
        {
          q: 'Do I need any technical knowledge?',
          a: 'Not at all. If you can post on Instagram, you can set up Hantaro. Most sellers are fully live within 10 minutes of signing up.',
        },
        {
          q: 'How do payments work in Malaysia?',
          a: 'Hantaro supports FPX online banking, DuitNow QR, and manual bank transfer. Payouts go directly to your bank account.',
        },
        {
          q: 'What is the platform fee?',
          a: 'Free Starter plan charges 2.5%–3% per transaction. Creator plan reduces this to 1.5%. Pro plan has 0% platform fee — you keep everything.',
        },
      ],
    }
  },

  methods: {
    handlePlanClick(plan) {
      if (plan.name === 'Starter') {
        window.location.href = '/admin/register'
      } else {
        window.location.href = `/admin/register?plan=${plan.name.toLowerCase()}`
      }
    },

    handleCtaSubmit() {
      if (this.ctaEmail) {
        window.location.href = `/admin/register?email=${encodeURIComponent(this.ctaEmail)}`
      }
    },
  },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

* { box-sizing: border-box; margin: 0; padding: 0; }

#app {
  font-family: 'Inter', sans-serif;
  background: #fff;
  color: #111;
  overflow-x: hidden;
}

/* ── NAV ── */
nav {
  position: fixed; top: 0; left: 0; right: 0; z-index: 100;
  background: rgba(255,255,255,.92); backdrop-filter: blur(16px);
  border-bottom: 1px solid #e5e7eb;
  display: flex; align-items: center; justify-content: space-between;
  padding: 0 40px; height: 72px;
}
.logo { font-size: 1.35rem; font-weight: 800; color: #000; letter-spacing: -.5px; }
.logo span { color: #F57C20; }
.nav-mid { display: flex; gap: 32px; }
.nav-mid a { font-size: .875rem; font-weight: 500; color: #555; text-decoration: none; transition: color .15s; }
.nav-mid a:hover { color: #000; }
.nav-right { display: flex; align-items: center; gap: 12px; }
.nav-login { font-size: .875rem; font-weight: 500; color: #555; text-decoration: none; transition: color .15s; }
.nav-login:hover { color: #000; }
.btn-orange { background: #F57C20; color: #fff; font-weight: 600; font-size: .875rem; padding: 10px 20px; border-radius: 10px; text-decoration: none; border: none; cursor: pointer; transition: background .15s; display: inline-block; }
.btn-orange:hover { background: #d96a15; }

/* ── HERO ── */
.hero {
  min-height: 100vh; padding-top: 72px;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  background: #000; position: relative; overflow: hidden; text-align: center;
  padding-left: 24px; padding-right: 24px; padding-bottom: 60px;
}
.hero-mesh {
  position: absolute; inset: 0; pointer-events: none;
  background:
    radial-gradient(ellipse 60% 55% at 50% 50%, rgba(245,124,32,.16) 0%, transparent 65%),
    radial-gradient(ellipse 35% 40% at 10% 20%, rgba(245,124,32,.09) 0%, transparent 60%),
    radial-gradient(ellipse 30% 35% at 90% 80%, rgba(245,124,32,.07) 0%, transparent 60%);
}
.hero-inner { position: relative; z-index: 2; max-width: 740px; }
.hero-tag {
  display: inline-flex; align-items: center; gap: 8px;
  background: rgba(245,124,32,.12); border: 1px solid rgba(245,124,32,.3);
  color: #F57C20; font-size: .75rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase;
  padding: 6px 14px; border-radius: 30px; margin-bottom: 28px;
}
.hero-dot { width: 6px; height: 6px; background: #F57C20; border-radius: 50%; animation: blink 2s ease-in-out infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
.hero h1 {
  font-size: clamp(2.6rem, 6vw, 4.8rem); font-weight: 900; line-height: 1.08;
  letter-spacing: -.04em; color: #fff; margin-bottom: 22px;
}
.hero h1 .accent { color: #F57C20; }
.hero p { font-size: 1.05rem; color: rgba(255,255,255,.5); font-weight: 400; line-height: 1.65; max-width: 500px; margin: 0 auto 36px; }
.hero-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-bottom: 64px; }
.btn-outline-w {
  background: transparent; color: rgba(255,255,255,.7); border: 1.5px solid rgba(255,255,255,.2);
  font-weight: 600; font-size: .875rem; padding: 10px 22px; border-radius: 10px;
  text-decoration: none; transition: border-color .15s, color .15s;
}
.btn-outline-w:hover { border-color: rgba(255,255,255,.5); color: #fff; }

/* ── PHONE ── */
.phone-row {
  display: flex; gap: 20px; justify-content: center; align-items: flex-end;
  position: relative; z-index: 2;
}
.phone {
  width: 220px; background: #111; border: 1.5px solid #2a2a2a;
  border-radius: 36px; padding: 12px 8px 8px;
  box-shadow: 0 50px 100px rgba(0,0,0,.8), 0 0 0 1px #1a1a1a;
}
.phone.side { width: 186px; opacity: .4; transform: scale(.9) translateY(28px); }
.phone-notch { width: 68px; height: 18px; background: #111; border-radius: 0 0 12px 12px; margin: 0 auto 8px; border: 1.5px solid #222; border-top: none; }
.phone-screen { background: #f4f4f4; border-radius: 26px; overflow: hidden; }
.pp-banner { height: 86px; background-size: cover; background-position: center; }
.pp-body { background: #f4f4f4; }
.pp-avatar-row { display: flex; justify-content: center; margin-top: -24px; margin-bottom: 6px; }
.pp-avatar { width: 48px; height: 48px; border-radius: 50%; border: 3px solid #f4f4f4; overflow: hidden; background: #ddd; }
.pp-avatar img { width: 100%; height: 100%; object-fit: cover; }
.pp-name { text-align: center; font-size: .7rem; font-weight: 800; color: #111; }
.pp-handle { text-align: center; font-size: .56rem; color: #F57C20; font-weight: 600; margin-bottom: 6px; }
.pp-socials { display: flex; gap: 4px; justify-content: center; margin-bottom: 8px; }
.pp-soc { width: 18px; height: 18px; border-radius: 50%; background: #e8e8e8; display: flex; align-items: center; justify-content: center; font-size: .5rem; }
.pp-items { padding: 0 7px 8px; display: flex; flex-direction: column; gap: 5px; }
.pp-item { background: #fff; border-radius: 9px; padding: 6px 8px; display: flex; align-items: center; gap: 7px; box-shadow: 0 1px 3px rgba(0,0,0,.07); }
.pp-item-thumb { width: 26px; height: 26px; border-radius: 6px; background-size: cover; background-position: center; flex-shrink: 0; }
.pp-item-info { flex: 1; }
.pp-item-name { font-size: .56rem; font-weight: 700; color: #111; line-height: 1.2; }
.pp-item-sub { font-size: .48rem; color: #999; }
.pp-item-right { text-align: right; flex-shrink: 0; }
.pp-item-price { font-size: .6rem; font-weight: 800; color: #F57C20; white-space: nowrap; }
.pp-item-btn { font-size: .44rem; font-weight: 700; background: #F57C20; color: #fff; padding: 2px 6px; border-radius: 20px; margin-top: 2px; display: inline-block; white-space: nowrap; }

/* ── MARQUEE ── */
.marquee-bar { background: #F57C20; padding: 11px 0; overflow: hidden; }
.marquee-track { display: flex; width: max-content; animation: scroll 22s linear infinite; }
.marquee-item { display: inline-flex; align-items: center; gap: 14px; padding: 0 32px; font-size: .74rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase; color: rgba(255,255,255,.9); white-space: nowrap; }
.m-dot { width: 4px; height: 4px; background: rgba(255,255,255,.5); border-radius: 50%; }
@keyframes scroll { from{transform:translateX(0)} to{transform:translateX(-50%)} }

/* ── STATS ── */
.stats { background: #f9f9f9; border-top: 1px solid #e5e7eb; border-bottom: 1px solid #e5e7eb; padding: 48px 24px; }
.stats-grid { max-width: 860px; margin: 0 auto; display: grid; grid-template-columns: repeat(3,1fr); text-align: center; }
.stat { padding: 8px 24px; border-right: 1px solid #e5e7eb; }
.stat:last-child { border-right: none; }
.stat-n { font-size: 2.8rem; font-weight: 900; color: #000; letter-spacing: -.04em; line-height: 1; }
.stat-n :deep(span) { color: #F57C20; }
.stat-d { font-size: .82rem; color: #888; margin-top: 6px; }

/* ── SECTION LABELS ── */
.sec-label { font-size: .72rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: #F57C20; margin-bottom: 12px; display: block; }
.sec-title { font-size: clamp(1.8rem, 3.5vw, 2.8rem); font-weight: 800; letter-spacing: -.03em; line-height: 1.1; color: #000; margin-bottom: 14px; }
.sec-sub { font-size: .95rem; color: #666; line-height: 1.65; max-width: 480px; }

/* ── SHOWCASE ── */
.showcase { padding: 96px 40px; }
.showcase-inner { max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 72px; align-items: center; }
.c-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,.07); }
.c-banner { height: 110px; background-size: cover; background-position: center; }
.c-body { padding: 0 20px 20px; }
.c-top-row { display: flex; align-items: flex-end; justify-content: space-between; margin-top: -22px; margin-bottom: 12px; }
.c-avatar { width: 46px; height: 46px; border-radius: 50%; border: 3px solid #fff; overflow: hidden; background: #eee; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
.c-avatar img { width: 100%; height: 100%; object-fit: cover; }
.c-link-pill { margin-top: 30px; font-size: .68rem; font-weight: 700; color: #F57C20; background: rgba(245,124,32,.07); border: 1px solid rgba(245,124,32,.2); padding: 4px 12px; border-radius: 20px; }
.c-name { font-size: 1rem; font-weight: 800; color: #000; margin-bottom: 2px; }
.c-handle { font-size: .75rem; color: #999; margin-bottom: 8px; }
.c-bio { font-size: .8rem; color: #555; line-height: 1.55; margin-bottom: 14px; }
.c-products { display: flex; flex-direction: column; gap: 8px; }
.c-prod { background: #f9f9f9; border: 1px solid #eee; border-radius: 12px; padding: 10px 12px; display: flex; align-items: center; gap: 12px; transition: border-color .15s; }
.c-prod:hover { border-color: #F57C20; }
.c-prod-img { width: 44px; height: 44px; border-radius: 8px; background-size: cover; background-position: center; flex-shrink: 0; }
.c-prod-info { flex: 1; }
.c-prod-name { font-size: .8rem; font-weight: 700; color: #000; }
.c-prod-sub { font-size: .68rem; color: #999; }
.c-prod-price { font-size: .88rem; font-weight: 800; color: #F57C20; white-space: nowrap; }
.c-prod-btn { background: #F57C20; color: #fff; font-size: .65rem; font-weight: 700; padding: 6px 12px; border-radius: 20px; border: none; cursor: pointer; transition: background .15s; white-space: nowrap; }
.c-prod-btn:hover { background: #d96a15; }
.checklist { display: flex; flex-direction: column; gap: 12px; margin-top: 28px; }
.check-item { display: flex; align-items: center; gap: 12px; }
.check-icon { width: 34px; height: 34px; border-radius: 9px; background: #fff7f0; border: 1px solid rgba(245,124,32,.15); display: flex; align-items: center; justify-content: center; font-size: .95rem; flex-shrink: 0; }
.check-text { font-size: .85rem; color: #555; line-height: 1.4; }

/* ── FEATURES ── */
.features { background: #000; padding: 96px 40px; }
.features-inner { max-width: 1100px; margin: 0 auto; }
.features-head { text-align: center; margin-bottom: 56px; }
.features-head .sec-title { color: #fff; }
.features-head .sec-sub { color: #555; margin: 0 auto; }
.feat-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1px; background: #1e1e1e; border: 1px solid #1e1e1e; border-radius: 20px; overflow: hidden; }
.feat-item { background: #0d0d0d; padding: 32px 26px; position: relative; transition: background .2s; }
.feat-item:hover { background: #141414; }
.feat-item::after { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:#F57C20; transform:scaleX(0); transform-origin:left; transition:transform .3s; }
.feat-item:hover::after { transform:scaleX(1); }
.feat-ico { width: 44px; height: 44px; border-radius: 12px; background: rgba(245,124,32,.08); border: 1px solid rgba(245,124,32,.12); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; margin-bottom: 18px; }
.feat-title { font-size: .95rem; font-weight: 700; color: #fff; margin-bottom: 8px; }
.feat-desc { font-size: .8rem; color: #555; line-height: 1.6; }

/* ── HOW IT WORKS ── */
.hiw { padding: 96px 40px; }
.hiw-inner { max-width: 960px; margin: 0 auto; }
.hiw-head { text-align: center; margin-bottom: 72px; }
.hiw-head .sec-sub { margin: 0 auto; }
.steps { display: grid; grid-template-columns: repeat(3,1fr); position: relative; }
.steps::before { content:''; position:absolute; top:25px; left:calc(16.6% + 14px); right:calc(16.6% + 14px); height:1px; background: linear-gradient(90deg,#F57C20,#e5e7eb,#F57C20); }
.step { text-align: center; padding: 0 28px; }
.step-num { width: 50px; height: 50px; border-radius: 50%; background: #F57C20; color: #fff; font-size: 1.1rem; font-weight: 800; display: flex; align-items: center; justify-content: center; margin: 0 auto 22px; box-shadow: 0 0 0 8px rgba(245,124,32,.1); }
.step-title { font-size: 1rem; font-weight: 700; color: #000; margin-bottom: 10px; }
.step-desc { font-size: .82rem; color: #666; line-height: 1.6; }
.step-url { display: inline-block; margin-top: 14px; font-size: .72rem; font-weight: 700; color: #F57C20; background: rgba(245,124,32,.07); border: 1px solid rgba(245,124,32,.2); padding: 5px 14px; border-radius: 20px; font-family: monospace; }

/* ── PRICING ── */
.pricing { padding: 96px 40px; background: #f9f9f9; }
.pricing-head { text-align: center; margin-bottom: 56px; }
.pricing-head .sec-sub { margin: 0 auto; }
.plans { max-width: 920px; margin: 0 auto; display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; }
.plan { background: #fff; border: 1.5px solid #e5e7eb; border-radius: 18px; padding: 28px 22px; position: relative; transition: box-shadow .2s, transform .2s; }
.plan:hover { transform: translateY(-4px); box-shadow: 0 20px 50px rgba(0,0,0,.08); }
.plan.pop { border-color: #F57C20; }
.plan-badge { position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: #F57C20; color: #fff; font-size: .68rem; font-weight: 700; padding: 4px 14px; border-radius: 20px; white-space: nowrap; }
.plan-name { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .09em; color: #999; margin-bottom: 10px; }
.plan-price { font-size: 2.6rem; font-weight: 900; color: #000; letter-spacing: -.04em; line-height: 1; margin-bottom: 4px; }
.plan-price :deep(sub) { font-size: .95rem; font-weight: 500; color: #999; vertical-align: middle; }
.plan-period { font-size: .75rem; color: #999; margin-bottom: 22px; }
.plan-feats { list-style: none; display: flex; flex-direction: column; gap: 9px; margin-bottom: 24px; }
.plan-feats li { display: flex; align-items: flex-start; gap: 9px; font-size: .8rem; color: #444; }
.plan-feats li::before { content:'✓'; color: #F57C20; font-weight: 800; flex-shrink: 0; margin-top: 1px; }
.plan-btn { width: 100%; padding: 12px; border-radius: 10px; font-size: .875rem; font-weight: 700; cursor: pointer; border: none; transition: background .15s, transform .1s; font-family: 'Inter', sans-serif; }
.plan-btn:hover { transform: translateY(-1px); }
.plan-btn.solid { background: #F57C20; color: #fff; }
.plan-btn.solid:hover { background: #d96a15; }
.plan-btn.outline { background: #fff; color: #F57C20; border: 1.5px solid #F57C20; }
.plan-btn.outline:hover { background: rgba(245,124,32,.05); }

/* ── FAQ ── */
.faq { padding: 96px 40px; }
.faq-inner { max-width: 680px; margin: 0 auto; }
.faq-head { text-align: center; margin-bottom: 48px; }
.faq-list { display: flex; flex-direction: column; gap: 8px; }
details { background: #fff; border: 1.5px solid #e5e7eb; border-radius: 14px; overflow: hidden; transition: border-color .2s; }
details[open] { border-color: #F57C20; }
summary { padding: 18px 20px; font-size: .9rem; font-weight: 600; color: #000; cursor: pointer; list-style: none; display: flex; justify-content: space-between; align-items: center; gap: 12px; user-select: none; }
summary::-webkit-details-marker { display: none; }
.faq-plus { width: 22px; height: 22px; border-radius: 50%; background: #fff7f0; display: flex; align-items: center; justify-content: center; font-size: 1rem; color: #F57C20; font-weight: 700; flex-shrink: 0; transition: transform .25s; }
details[open] .faq-plus { transform: rotate(45deg); }
.faq-ans { padding: 0 20px 18px; font-size: .83rem; color: #666; line-height: 1.7; }

/* ── CTA ── */
.cta { padding: 96px 40px; background: #000; text-align: center; }
.cta-inner { max-width: 580px; margin: 0 auto; }
.cta .sec-label { display: block; margin-bottom: 12px; }
.cta-note { font-size: .72rem; color: #444; }
.cta-row { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; margin: 32px 0 16px; }
.cta-input { background: #111; border: 1.5px solid #222; color: #fff; padding: 13px 18px; border-radius: 10px; font-family: 'Inter',sans-serif; font-size: .875rem; width: 280px; outline: none; transition: border-color .15s; }
.cta-input::placeholder { color: #444; }
.cta-input:focus { border-color: #F57C20; }

/* ── FOOTER ── */
footer { background: #fff; border-top: 1px solid #e5e7eb; padding: 24px 40px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
footer p { font-size: .78rem; color: #999; }
.foot-links { display: flex; gap: 20px; }
.foot-links a { font-size: .78rem; color: #999; text-decoration: none; transition: color .15s; }
.foot-links a:hover { color: #000; }

/* ── RESPONSIVE ── */
@media(max-width:960px){
  nav { padding: 0 20px; }
  .nav-mid { display: none; }
  .showcase-inner { grid-template-columns: 1fr; gap: 40px; }
  .feat-grid { grid-template-columns: 1fr 1fr; }
  .steps { grid-template-columns: 1fr; gap: 36px; }
  .steps::before { display: none; }
  .plans { grid-template-columns: 1fr; max-width: 360px; }
  .stats-grid { grid-template-columns: 1fr; }
  .stat { border-right: none; border-bottom: 1px solid #e5e7eb; padding: 20px; }
  .stat:last-child { border-bottom: none; }
  .phone.side { display: none; }
  footer { flex-direction: column; text-align: center; }
}
@media(max-width:600px){
  .feat-grid { grid-template-columns: 1fr; }
  .hero h1 { font-size: 2.4rem; }
  .showcase, .features, .hiw, .pricing, .faq, .cta { padding: 70px 20px; }
}
</style>