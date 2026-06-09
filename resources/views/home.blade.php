@extends('layouts.app')
@section('title', 'Home')

@push('styles')
<script src="https://cdn.lordicon.com/lordicon.js"></script>
<style>
    /* ── HERO ── */
    .hero {
        min-height: 95vh;
        background: linear-gradient(160deg, #01203c 0%, #052a48 50%, #0a3050 100%);
        display: flex; flex-direction: column;
        position: relative; overflow: hidden;
        padding: 180px 0 175px;
    }
    .hero-container {
        display: grid; grid-template-columns: 55fr 45fr;
        gap: 80px; align-items: center;
        width: 100%;
        padding: 0 80px;
        position: relative; z-index: 2;
    }
    /* Background foto slideshow */
    .hero-bg {
        position: absolute; inset: 0;
        z-index: 0;
    }
    .hero-bg-slide {
        position: absolute; inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0;
        transition: opacity 2s ease-in-out;
        will-change: opacity;
    }
    .hero-bg-slide.active { opacity: 1; }
    .hero-bg-slide:nth-child(1) { background-image: url('{{ asset("img/bg/bg1.jpeg") }}'); }
    .hero-bg-slide:nth-child(2) { background-image: url('{{ asset("img/bg/bg2.jpeg") }}'); }

    /* Overlay global — selalu ada, warna dasar gelap agar teks terbaca */
    .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(
            135deg,
            rgba(1,32,60,0.85) 0%,
            rgba(5,42,72,0.75) 45%,
            rgba(10,48,80,0.80) 100%
        );
        z-index: 1;
    }

    /* Overlay kiri — ikut fade in/out bersama foto, hanya di sisi kiri (area teks) */
    .hero-overlay-left {
        position: absolute; inset: 0;
        background: linear-gradient(
            to right,
            rgba(1,32,60,1) 0%,
            rgba(1,32,60,0.95) 20%,
            rgba(1,32,60,0.7) 40%,
            rgba(1,32,60,0.2) 60%,
            transparent 75%
        );
        z-index: 2;
        opacity: 0;
        transition: opacity 2s ease-in-out;
        will-change: opacity;
        pointer-events: none;
    }
    .hero-overlay-left.active { opacity: 1; }

    /* LEFT */
    .hero-tag {
        display: inline-flex; align-items: center; gap: 10px;
        background: linear-gradient(rgba(10,14,42,0.7), rgba(10,14,42,0.7)) padding-box,
                    linear-gradient(to right, #00d4ff, #8b5cf6) border-box;
        border: 1.5px solid transparent;
        border-radius: 100px;
        padding: 12px 28px;
        font-size: 16px; font-weight: 700;
        color: white;
        margin-bottom: 24px;
        box-shadow: 0 0 16px rgba(0,212,255,0.1);
    }
    .hero-tag .trophy-icon {
        font-size: 18px;
        filter: drop-shadow(0 0 6px rgba(255,215,0,0.5));
    }
    .hero-content h1 {
        font-size: clamp(40px, 5.5vw, 62px);
        font-weight: 900; color: white;
        line-height: 1.15; margin-bottom: 24px;
        letter-spacing: -0.5px;
    }
    .hero-content h1 .highlight,
    .hero-content h1 .accent {
        background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-desc {
        font-size: 18px; color: rgba(255,255,255,0.8);
        line-height: 1.8; margin-bottom: 36px;
        max-width: 560px;
    }
    .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 48px; }
    .hero-actions .btn-accent {
        background: linear-gradient(90deg, #0668C0, #7035CC, #7035CC, #0668C0);
        background-size: 200% 100%;
        background-position: 0% 0%;
        border: none;
        border-radius: 14px;
        color: white;
        box-shadow: 0 4px 20px rgba(112,53,204,0.25);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .hero-actions .btn-accent:hover {
        transform: translateY(-2px);
        background-position: 100% 0%;
        box-shadow: 0 8px 28px rgba(112,53,204,0.35);
    }
    .hero-actions .btn-hero-outline {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 16px 36px; border-radius: 14px;
        font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 700;
        background: transparent;
        color: white;
        text-decoration: none; cursor: pointer;
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .hero-actions .btn-hero-outline::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 14px;
        padding: 1.5px;
        background: linear-gradient(to right, #00d4ff, #8b5cf6);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }
    .hero-actions .btn-hero-outline:hover {
        transform: translateY(-2px);
        background: linear-gradient(90deg, #0668C0, #7035CC);
    }
    .hero-stats-wrap {
        position: relative;
        z-index: 3;
        margin-top: -100px;
        padding: 0 24px;
    }
    .hero-stats-wrap .hero-stats {
        max-width: 1600px;
        margin: 0 auto;
    }
    .hero-stats {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        background: #041640;
        border-radius: 16px;
        padding: 24px 24px 16px;
        gap: 16px;
        position: relative;
        box-shadow:
            0 0 40px rgba(0,212,255,0.1),
            inset 0 2px 0 rgba(0,212,255,0.35),
            inset 0 -2px 0 rgba(0,212,255,0.2),
            inset 2px 0 0 rgba(0,212,255,0.15),
            inset -2px 0 0 rgba(0,212,255,0.15);
    }
    .hero-stat {
        display: flex; flex-direction: column;
        align-items: center; text-align: center;
        padding: 4px 12px;
    }
    .hero-stat .num {
        font-size: 30px; font-weight: 900;
        background: linear-gradient(90deg, #4FC3F7, #7C4DFF);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1; margin-bottom: 4px;
        font-family: 'Poppins', sans-serif;
    }
    .hero-stat .num .star {
        -webkit-text-fill-color: #7C4DFF;
        color: #7C4DFF;
    }
    .hero-stat .label {
        font-size: 13px; color: rgba(255,255,255,0.7);
        font-weight: 500;
    }

    /* RIGHT: Visual */
    .hero-visual {
        position: relative;
        display: flex; align-items: center; justify-content: center;
    }
    .hero-visual-main {
        position: relative;
        width: 100%; max-width: 520px; aspect-ratio: 1;
        background: rgba(0,212,255,0.04);
        border: 1.5px solid rgba(0,212,255,0.15);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 24px 64px rgba(0,0,0,0.3), 0 0 40px rgba(0,212,255,0.06);
        animation: pulse 4s ease-in-out infinite;
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50%       { transform: scale(1.03); }
    }
    .hero-visual-icon { font-size: 120px; filter: drop-shadow(0 8px 24px rgba(0,0,0,0.3)); }
    .hero-visual-float {
        position: absolute;
        background: #0d0d5b;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(0,212,255,0.12);
        border-radius: 16px;
        padding: 16px 22px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        display: flex; align-items: center; gap: 12px;
        animation: floatCard 3s ease-in-out infinite;
    }
    @keyframes floatCard {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-10px); }
    }
    .hero-visual-float.f1 { top: 8%; left: 8%; animation-delay: 0s; }
    .hero-visual-float.f2 { top: 55%; right: 8%; animation-delay: 1s; }
    .hero-visual-float.f3 { bottom: 8%; left: 18%; animation-delay: 2s; }
    .hero-visual-float .ficon {
        width: 38px; height: 38px;
        background: var(--primary-light); border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
    }
    .hero-visual-float .ftext { font-size: 13px; font-weight: 700; color: var(--text); white-space: nowrap; }

    /* ── TENTANG ── */
    .tentang {
        background: #020D2E;
        position: relative; overflow: hidden;
        padding: 120px 0;
    }
    .tentang::after {
        content: ''; position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='1440' height='300' viewBox='0 0 1440 300' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 150 Q 360 300 720 150 T 1440 150' fill='none' stroke='rgba(0,212,255,0.05)' stroke-width='2'/%3E%3C/svg%3E") repeat-x bottom;
        background-size: 1440px auto;
        pointer-events: none;
        opacity: 0.6;
        z-index: 1;
    }
    .tentang .container {
        display: grid; grid-template-columns: 60fr 40fr;
        gap: 120px; align-items: center;
        position: relative; z-index: 2;
    }
    .tentang-foto {
        border-radius: 20px; overflow: hidden;
        box-shadow: 0 24px 64px rgba(0,0,0,0.4), 0 0 0 1px rgba(0,212,255,0.1);
        position: relative;
        transition: transform 0.5s cubic-bezier(0.4,0,0.2,1), box-shadow 0.5s cubic-bezier(0.4,0,0.2,1);
    }
    .tentang-foto:hover {
        transform: scale(1.03);
        box-shadow: 0 32px 80px rgba(0,212,255,0.2), 0 0 0 2px rgba(0,212,255,0.3);
    }
    .tentang-foto img {
        width: 100%; height: 100%; object-fit: cover;
        display: block;
        transition: transform 0.6s cubic-bezier(0.4,0,0.2,1);
    }
    .tentang-foto:hover img {
        transform: scale(1.08);
    }
    .tentang-foto::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(0,212,255,0.15) 0%, transparent 60%);
        pointer-events: none;
    }
    .tentang-teks h2 {
        font-size: clamp(28px, 3vw, 38px);
        font-weight: 900;
        line-height: 1.2; margin-bottom: 24px;
        white-space: nowrap;
        background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .tentang-teks p {
        font-size: 17px; color: rgba(255,255,255,0.75);
        line-height: 1.9; margin-bottom: 36px;
        max-width: 560px;
    }
    .tentang-teks .btn-tentang {
        position: relative;
        display: inline-flex; align-items: center;
        padding: 12px 28px 12px 44px;
        border: 1px solid rgba(6,104,192,0.15);
        border-radius: 100px;
        font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 600;
        color: white;
        text-decoration: none; cursor: pointer;
        background: linear-gradient(90deg, #0668C0, #7035CC, #7035CC, #0668C0);
        background-size: 200% 100%;
        background-position: 0% 0%;
        box-shadow: 0 4px 20px rgba(112,53,204,0.25);
        overflow: hidden;
        transition: padding 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                    background-position 0.5s ease;
    }
    .tentang-teks .btn-tentang:hover {
        padding: 12px 44px 12px 28px;
        background-position: 100% 0%;
    }
    .tentang-teks .btn-tentang .arrow-wrap {
        position: absolute;
        top: 50%; left: 5px;
        transform: translateY(-50%) rotate(0deg);
        width: 28px; height: 28px; border-radius: 50%;
        background: white;
        display: flex; align-items: center; justify-content: center;
        transition: left 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                    transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .tentang-teks .btn-tentang:hover .arrow-wrap {
        left: calc(100% - 33px);
        transform: translateY(-50%) rotate(45deg);
    }
    .tentang-teks .btn-tentang .arrow-wrap img {
        width: 14px; height: 14px; object-fit: contain; display: block;
    }

    /* ── WHY CHOOSE US ── */
    .why-section { background: #041640; padding: 140px 0; }
    .why-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 100px; align-items: start; }
    .why-heading { margin: 0; }
    .why-heading h2 { font-size: clamp(28px, 3.5vw, 40px); font-weight: 900; color: white; margin: 0 0 12px; line-height: 1.2; }
    .why-heading .why-accent { font-size: clamp(28px, 3.5vw, 40px); font-weight: 700; margin-bottom: 16px; display: block; background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .why-heading p { font-size: 15px; color: var(--text-muted); line-height: 1.7; max-width: 420px; margin: 0; }
    .why-accordion { display: flex; flex-direction: column; gap: 33px; }
    .why-accordion details {
        background: #0D2460;
        border: 1px solid rgba(0,212,255,0.15);
        border-radius: 16px;
        overflow: hidden;
        transition: border-color 0.3s;
    }
    .why-accordion details[open] { border-color: rgba(0,212,255,0.4); }
    .why-accordion summary {
        padding: 22px 28px;
        display: flex; align-items: center; gap: 16px;
        cursor: pointer; list-style: none;
        font-size: 17px; font-weight: 600; color: white;
        user-select: none;
    }
    .why-accordion summary::-webkit-details-marker { display: none; }
    .why-accordion summary .check { color: #00d4ff; font-size: 20px; flex-shrink: 0; }
    .why-accordion summary .chevron {
        margin-left: auto; flex-shrink: 0;
        transition: transform 0.3s;
        color: var(--text-muted); font-size: 14px;
    }
    .why-accordion details[open] summary .chevron { transform: rotate(180deg); }
    .why-accordion .why-body {
        padding: 0 28px 24px 60px;
        font-size: 15px; color: var(--text-muted); line-height: 1.7;
    }
    @media (max-width: 900px) {
        .why-grid { grid-template-columns: 1fr; gap: 40px; }
    }

    /* ── PRODUK UNGGULAN ── */
    .produk-section { background: #020D2E; }
    .produk-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
    .produk-card {
        background: #0A1E50;
        border: 1px solid rgba(0,212,255,0.12);
        border-radius: 20px;
        padding: 40px 28px 36px;
        display: flex; flex-direction: column;
        transition: border-color 0.3s, transform 0.3s;
    }
    .produk-card:hover {
        border-color: rgba(0,212,255,0.35);
        transform: translateY(-4px);
    }
    .produk-card .p-icon {
        position: relative;
        width: 52px; height: 52px;
        border-radius: 50%;
        background: transparent;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        margin-bottom: 20px;
    }
    .produk-card .p-icon::before {
        content: '';
        position: absolute; inset: 0;
        border-radius: 50%;
        padding: 1.5px;
        background: linear-gradient(135deg, #00d4ff, #7c3aed);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }
    .produk-card h3 { font-size: 18px; font-weight: 700; color: white; margin: 0 0 10px; }
    .produk-card p { font-size: 14px; color: var(--text-muted); line-height: 1.6; margin: 0 0 24px; flex: 1; border-bottom: 1px solid rgba(0,212,255,0.1); padding-bottom: 24px; }
    .produk-card .p-price-label { font-size: 12px; color: var(--text-muted); margin-bottom: 2px; }
    .produk-card .p-price { font-size: 32px; font-weight: 500; margin-bottom: 20px; font-family: 'Poppins', sans-serif; background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .produk-card .p-btn {
        position: relative;
        display: inline-flex; align-items: center;
        padding: 10px 24px 10px 46px;
        border: 1px solid rgba(6,104,192,0.15);
        border-radius: 100px;
        font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600;
        color: white;
        text-decoration: none;
        background: linear-gradient(90deg, #0668C0, #7035CC, #7035CC, #0668C0);
        background-size: 200% 100%;
        background-position: 0% 0%;
        box-shadow: 0 4px 20px rgba(112,53,204,0.25);
        overflow: hidden;
        align-self: flex-start;
        transition: padding 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                    background-position 0.5s ease;
    }
    .produk-card .p-btn:hover {
        padding: 10px 46px 10px 24px;
        background-position: 100% 0%;
    }
    .produk-card .p-btn .p-btn-icon {
        position: absolute;
        top: 50%; left: 5px;
        transform: translateY(-50%) rotate(0deg);
        width: 28px; height: 28px; border-radius: 50%;
        background: white;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; color: #7035CC;
        transition: left 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                    transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .produk-card .p-btn:hover .p-btn-icon {
        left: calc(100% - 33px);
        transform: translateY(-50%) rotate(45deg);
    }
    @media (max-width: 1100px) { .produk-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 600px)  { .produk-grid { grid-template-columns: 1fr; } }

    /* ── CTA ── */
    /* ── BERITA TERBARU ── */
    .berita-section { background: #041640; }
    .berita-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .berita-card {
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        aspect-ratio: 4/3;
        cursor: pointer;
        transition: box-shadow 0.35s ease;
    }
    .berita-card:hover { box-shadow: 0 0 0 2px rgba(0,212,255,0.5), 0 0 24px rgba(0,212,255,0.3); }
    .berita-card img {
        width: 100%; height: 100%; object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .berita-card:hover img { transform: scale(1.08); }
    .berita-card .berita-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(0deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.1) 60%, transparent 100%);
        pointer-events: none;
        transition: opacity 0.35s ease;
        z-index: 1;
    }
    .berita-card .berita-hover-top {
        position: absolute; top: 0; left: 0; right: 0; height: 55%;
        background: linear-gradient(180deg, rgba(0,0,0,0.85) 0%, transparent 100%);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 2;
    }
    .berita-card:hover .berita-hover-top { opacity: 1; }
    .berita-card .berita-hover-bottom {
        position: absolute; bottom: 0; left: 0; right: 0; height: 70%;
        background: linear-gradient(0deg, rgba(0,100,200,1) 0%, transparent 100%);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 2;
    }
    .berita-card:hover .berita-overlay { opacity: 0; }
    .berita-card:hover .berita-hover-top { opacity: 1; }
    .berita-card:hover .berita-hover-bottom { opacity: 1; }
    .berita-card .berita-info {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 24px 20px 20px;
        pointer-events: none;
        z-index: 3;
    }
    .berita-card .berita-info h3 {
        font-size: 15px; font-weight: 700; color: white;
        margin: 0 0 6px; line-height: 1.4;
        transition: opacity 0.3s ease;
    }
    .berita-card:hover .berita-info h3 { opacity: 0; }
    .berita-card .berita-info .berita-date {
        font-size: 12px; color: rgba(255,255,255,0.7);
        display: flex; align-items: center; gap: 6px;
    }
    .berita-card .berita-desc {
        position: absolute;
        top: 22%; left: 24px; right: 24px;
        font-size: 13px; color: white;
        line-height: 1.6; text-align: left;
        opacity: 0;
        transition: opacity 0.35s ease 0.1s;
        pointer-events: none;
        z-index: 3;
    }
    .berita-card:hover .berita-desc { opacity: 1; }
    @media (max-width: 900px) { .berita-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 600px) { .berita-grid { grid-template-columns: 1fr; } }

    /* ── TESTIMONIAL CAROUSEL ── */
    .testimoni-section { background: #020D2E; overflow: hidden; }
    .testimoni-carousel-wrap { position: relative; max-width: 1000px; margin: 0 auto; }
    .testimoni-track {
        position: relative;
        min-height: 360px;
    }
    .testimoni-slide {
        position: absolute; left: 50%; width: 300px;
        border-radius: 16px; padding: 28px 24px;
        box-sizing: border-box;
        cursor: pointer; user-select: none;
        background: linear-gradient(135deg, #0D2460, #122a70);
        box-shadow: 0 8px 40px rgba(0,0,0,0.4);
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .testimoni-slide .ts-avatar {
        display: flex; align-items: center; gap: 14px; margin-bottom: 16px;
    }
    .testimoni-slide .ts-avatar .ts-avatar-img {
        width: 44px; height: 44px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 16px; color: white;
    }
    .testimoni-slide .ts-avatar .ts-name { font-weight: 700; color: white; font-size: 15px; }
    .testimoni-slide .ts-avatar .ts-label { font-size: 12px; color: rgba(255,255,255,0.6); margin-top: 2px; }
    .testimoni-slide .ts-text {
        font-style: italic; font-size: 14px; line-height: 1.7;
        color: rgba(255,255,255,0.9);
    }
    .testimoni-slide .ts-text::before { content: '\201C'; font-size: 28px; color: #1a8cff; line-height: 1; display: block; margin-bottom: 4px; }
    .testimoni-slide .ts-text::after  { content: '\201D'; font-size: 28px; color: #1a8cff; line-height: 0; display: inline-block; vertical-align: -8px; margin-left: 2px; }
    .testimoni-dots {
        display: flex; align-items: center; justify-content: center; gap: 10px;
        margin-top: 32px;
    }
    .testimoni-dots .tdot {
        width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.25);
        cursor: pointer; transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1), border-radius 0.5s cubic-bezier(0.4, 0, 0.2, 1), background 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: none; padding: 0;
    }
    .testimoni-dots .tdot.active {
        width: 48px; border-radius: 4px;
        background: linear-gradient(90deg, #0668C0, #7035CC, #7035CC, #0668C0);
    }
    @media (max-width: 768px) {
        .testimoni-slide { width: 220px; padding: 22px 18px; }
        .testimoni-slide .ts-text { font-size: 13px; }
    }
    @media (max-width: 480px) {
        .testimoni-slide { width: 180px; padding: 18px 14px; }
        .testimoni-slide .ts-avatar .ts-avatar-img { width: 36px; height: 36px; font-size: 13px; }
        .testimoni-slide .ts-text { font-size: 12px; }
    }

    /* ── PAYMENT MARQUEE + CTA ── */
    .payment-section { background: #041640; }
    .payment-marquee {
        overflow: hidden;
        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
        mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
        padding: 32px 0;
    }
    .payment-marquee:hover .marquee-track {
        animation-play-state: paused;
    }
    .marquee-track {
        display: flex; gap: 48px; width: max-content;
        animation: marqueeScroll 25s linear infinite;
    }
    @keyframes marqueeScroll {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .pay-logo {
        flex-shrink: 0; display: flex; align-items: center; justify-content: center;
        cursor: pointer; text-decoration: none;
    }
    .pay-logo img {
        transition: filter 0.3s ease, transform 0.3s ease;
    }
    .pay-logo:hover img {
        filter: brightness(1.3) drop-shadow(0 0 12px rgba(0,212,255,0.6));
        transform: translateY(-2px);
    }

    .cta-bottom {
        padding: 80px 24px 100px; text-align: center;
    }
    .cta-bottom h2 {
        font-size: clamp(28px, 4vw, 42px); font-weight: 900;
        color: white; margin: 0 0 16px;
    }
    .cta-bottom p {
        font-size: 16px; color: rgba(255,255,255,0.6);
        max-width: 520px; margin: 0 auto 36px; line-height: 1.7;
    }
    .cta-bottom .btn-hubungi {
        display: inline-flex; align-items: center; gap: 12px;
        padding: 16px 40px; border-radius: 50px;
        background: linear-gradient(135deg, #7c3aed, #2563eb);
        color: white; font-weight: 700; font-size: 16px;
        text-decoration: none; border: none; cursor: pointer;
        transition: all 0.3s ease;
    }
    .cta-bottom .btn-hubungi:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(124,58,237,0.4);
    }
    .cta-bottom .btn-hubungi .btn-icon-wrap {
        width: 32px; height: 32px; border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex; align-items: center; justify-content: center;
        font-size: 14px; flex-shrink: 0;
    }

    /* ── HERO ENTRANCE ANIMATIONS ── */
    @keyframes heroFadeUp {
        from { opacity: 0; transform: translateY(32px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes heroFadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
    .hero-tag     { animation: heroFadeUp 0.7s cubic-bezier(0.4,0,0.2,1) 0.2s both; }
    .hero-content h1   { animation: heroFadeUp 0.7s cubic-bezier(0.4,0,0.2,1) 0.35s both; }
    .hero-desc    { animation: heroFadeUp 0.7s cubic-bezier(0.4,0,0.2,1) 0.5s both; }
    .hero-actions { animation: heroFadeUp 0.7s cubic-bezier(0.4,0,0.2,1) 0.65s both; }
    .hero-stats   { animation: heroFadeUp 0.7s cubic-bezier(0.4,0,0.2,1) 0.8s both; }
    .hero-visual  { animation: heroFadeIn 1s cubic-bezier(0.4,0,0.2,1) 0.4s both; }
    @media (max-width: 1100px) {
        .hero-container { padding: 0 40px; gap: 48px; }
    }
    @media (max-width: 900px) {
        .hero-container { grid-template-columns: 1fr; gap: 48px; text-align: center; padding: 0 24px; }
        .hero-desc { margin-left: auto; margin-right: auto; }
        .hero-actions { justify-content: center; }
        .hero-stats { grid-template-columns: repeat(2, 1fr); padding: 16px 12px; gap: 8px; }
        .hero-stat .num { font-size: 24px; }
        .hero-stat .label { font-size: 11px; }
        .hero-stat:last-child { grid-column: 1 / -1; }
        .hero-stats-wrap { margin-top: -200px; }
        .hero { padding-bottom: 250px; }
        .hero-visual { justify-content: center; padding-right: 0; }
        .hero-visual-float { scale: 0.85; }
        .hero-visual-float.f1 { top: -6%; left: -4%; }
        .hero-visual-float.f2 { top: auto; bottom: 0; right: -4%; }
        .hero-visual-float.f3 { bottom: 12%; left: -2%; }
        .tentang { padding: 80px 0; }
        .tentang .container { grid-template-columns: 1fr; gap: 48px; text-align: center; }
        .tentang-teks { text-align: center; }
        .tentang-teks p { margin-left: auto; margin-right: auto; }
        .tentang-teks .btn-tentang { padding: 12px 44px 12px 28px; }
        .tentang-teks .btn-tentang .arrow-wrap { left: calc(100% - 33px); transform: translateY(-50%) rotate(45deg); }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="hero">
    {{-- Background slideshow --}}
    <div class="hero-bg">
        <div class="hero-bg-slide active"></div>
        <div class="hero-bg-slide"></div>
    </div>
    {{-- Overlay global --}}
    <div class="hero-overlay"></div>
    {{-- Overlay kiri ikut fade bersama foto --}}
    <div class="hero-overlay-left active" id="heroOverlayLeft"></div>
    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-tag">
                <span class="trophy-icon">🏆</span>
                Digital Gaming Commerce Terpercaya di Bandung
            </div>
            <h1>
                <span class="highlight">Pusat Jual Beli Akun</span><br>
                <span class="accent">Game Online Terpercaya</span><br>
            </h1>
            <p class="hero-desc">
                PT. Johen Sukses Abadi (JOHEN GAMING) — Solusi lengkap untuk jual beli akun game online, top up game, jasa joki, live commerce, dan konten digital gaming. Proses cepat, aman, dan transparan.
            </p>
            <div class="hero-actions">
                <a href="{{ route('kontak') }}" class="btn btn-accent btn-lg">
                    <i class="fas fa-headset"></i> Konsultasi Sekarang
                </a>
                <a href="{{ route('produk') }}" class="btn btn-hero-outline">
                    <i class="fas fa-th-large"></i> Lihat Produk
                </a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-visual-main">
                <img src="{{ asset('img/icon/icon_mengambang_logo.png') }}" alt="Johen Gaming" style="width:80%;height:80%;object-fit:contain;position:relative;z-index:1;filter:drop-shadow(0 8px 24px rgba(0,0,0,0.3));">
            </div>
            <div class="hero-visual-float f1">
                <div class="ficon" style="background:none;"><img src="{{ asset('img/icon/jamanimasi.webp') }}" alt="Proses Instan" style="width:38px;height:38px;object-fit:contain;"></div><span class="ftext">Proses Instan</span>
            </div>
            <div class="hero-visual-float f2">
                <div class="ficon" style="background:none;"><img src="{{ asset('img/icon/privacyanimasi.webp') }}" alt="100% Aman" style="width:38px;height:38px;object-fit:contain;"></div><span class="ftext">100% Aman</span>
            </div>
            <div class="hero-visual-float f3">
                <div class="ficon" style="background:none;"><img src="{{ asset('img/icon/coinanimasi.webp') }}" alt="Harga Terbaik" style="width:38px;height:38px;object-fit:contain;"></div><span class="ftext">Harga Terbaik</span>
            </div>
        </div>
    </div>

</section>

{{-- STATS (menggantung antara hero & features) --}}
<div class="hero-stats-wrap">
    <div class="hero-stats">
        <div class="hero-stat"><span class="num" data-target="2022">0</span><span class="label">Berdiri Sejak</span></div>
        <div class="hero-stat"><span class="num" data-target="5+">0</span><span class="label">Divisi Store</span></div>
        <div class="hero-stat"><span class="num"><span class="star">★</span> <span data-target="4.9">0</span></span><span class="label">Rating Rata Rata</span></div>
        <div class="hero-stat"><span class="num" data-target="100%">0</span><span class="label">Keamanan Terjamin</span></div>
    </div>
</div>

{{-- TENTANG --}}
<section class="tentang">
    <div class="container">
        <div class="tentang-foto reveal-left">
            <img src="{{ asset('img/figma/about-team.jpg') }}" alt="Tim PT. Johen Sukses Abadi">
        </div>
        <div class="tentang-teks reveal-right">
            <h2>PT. JOHEN SUKSES ABADI</h2>
            <p>PT. Johen Sukses Abadi merupakan perusahaan berlokasi di Kota Bandung, yang bergerak di bidang digital gaming commerce serta pengembangan ekosistem bisnis industri game online, yang berdiri sejak 2022. Kami hadir sebagai solusi terpercaya dalam menyediakan berbagai layanan bagi pemain game dan komunitas digital di Indonesia.</p>
            <a href="{{ route('tentang') }}" class="btn-tentang">
                <span class="arrow-wrap"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→"></span>
                Pelajari Tentang Kami
            </a>
        </div>
    </div>
</section>

{{-- WHY CHOOSE US --}}
<section class="section why-section">
    <div class="container">
        <div class="why-grid">
            <div class="why-heading reveal">
                <h2>Kenapa Memilih Kami?</h2>
                <span class="why-accent">Ini yang Membuat Kami Berbeda</span>
                <p>Memberikan layanan game terpercaya dengan proses cepat, aman, dan transparan untuk setiap transaksi.</p>
            </div>
            <div class="why-accordion reveal">
                <details>
                    <summary><span class="check"><img src="{{ asset('img/icon/centang.png') }}" alt="✔" style="width:20px;height:20px;display:block"></span> Standar Keamanan Akun Terbaik <span class="chevron">∨</span></summary>
                    <div class="why-body">Kami menerapkan sistem keamanan berlapis untuk memastikan setiap transaksi dan data akun Anda tetap aman dan terlindungi.</div>
                </details>
                <details>
                    <summary><span class="check"><img src="{{ asset('img/icon/centang.png') }}" alt="✔" style="width:20px;height:20px;display:block"></span> Proses Cepat dan Transparan <span class="chevron">∨</span></summary>
                    <div class="why-body">Setiap pesanan diproses secara otomatis dalam hitungan menit dengan status real-time yang bisa Anda pantau langsung.</div>
                </details>
                <details>
                    <summary><span class="check"><img src="{{ asset('img/icon/centang.png') }}" alt="✔" style="width:20px;height:20px;display:block"></span> Customer Support Resepsionif <span class="chevron">∨</span></summary>
                    <div class="why-body">Tim customer support kami siap membantu Anda 24/7 melalui WhatsApp, email, dan live chat dengan respon cepat dan ramah.</div>
                </details>
            </div>
        </div>
    </div>
</section>

{{-- PRODUK UNGGULAN --}}
<section class="section produk-section">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="section-title">Produk Unggulan Kami</h2>
            <p class="section-subtitle">Produk digital gaming commerce terbaik yang kami sediakan untuk kebutuhan game Anda.</p>
        </div>
        <div class="produk-grid">
            <div class="produk-card reveal">
                <div class="p-icon"><img src="{{ asset('img/icon/wallet.png') }}" alt="Top Up" style="width:26px;height:26px;object-fit:contain;"></div>
                <h3>Top Up Games</h3>
                <p>Top Up diamond, UC, dan mata uang game lainnya dengan harga terbaik</p>
                <div class="p-price-label">Mulai dari</div>
                <div class="p-price">Rp 5.000</div>
                <a href="{{ route('produk') }}" class="p-btn">
                    <span class="p-btn-icon"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→" style="width:12px;height:12px;object-fit:contain;"></span>
                    Lihat Selengkapnya
                </a>
            </div>
            <div class="produk-card reveal">
                <div class="p-icon"><img src="{{ asset('img/icon/gamepad.png') }}" alt="Joki" style="width:26px;height:26px;object-fit:contain;"></div>
                <h3>Joki Mobile Legends</h3>
                <p>Tingkatkan rank, selesaikan misi dan capai target gaming anda</p>
                <div class="p-price-label">Mulai dari</div>
                <div class="p-price">Rp 10.000</div>
                <a href="{{ route('produk.joki-ml') }}" class="p-btn">
                    <span class="p-btn-icon"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→" style="width:12px;height:12px;object-fit:contain;"></span>
                    Lihat Selengkapnya
                </a>
            </div>
            <div class="produk-card reveal">
                <div class="p-icon"><img src="{{ asset('img/icon/tasicon.png') }}" alt="Jual Beli" style="width:26px;height:26px;object-fit:contain;"></div>
                <h3>Jual Beli Akun Games</h3>
                <p>Marketplace akun game berkualitas dengan harga terbaik dan aman</p>
                <div class="p-price-label">Mulai dari</div>
                <div class="p-price">Rp 100.000</div>
                <a href="{{ route('produk.jual-beli-akun') }}" class="p-btn">
                    <span class="p-btn-icon"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→" style="width:12px;height:12px;object-fit:contain;"></span>
                    Lihat Selengkapnya
                </a>
            </div>
            <div class="produk-card reveal">
                <div class="p-icon"><img src="{{ asset('img/icon/camvid.png') }}" alt="Live Commerce" style="width:26px;height:26px;object-fit:contain;"></div>
                <h3>Live Commerce</h3>
                <p>Saksikan live streaming kami dan dapatkan penawaran terbaik</p>
                <div class="p-price-label">Mulai dari</div>
                <div class="p-price">Rp 10.000</div>
                <a href="{{ route('produk.live-commerce') }}" class="p-btn">
                    <span class="p-btn-icon"><img src="{{ asset('img/icon/petunjuk.png') }}" alt="→" style="width:12px;height:12px;object-fit:contain;"></span>
                    Lihat Selengkapnya
                </a>
            </div>
        </div>
    </div>
</section>

{{-- BERITA TERBARU --}}
<section class="section berita-section">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="section-title">Berita dan Update Terbaru</h2>
            <p class="section-subtitle">Informasi terkini seputar dunia gaming dan update dari Johen Gaming.</p>
        </div>
        <div class="berita-grid">
            <div class="berita-card">
                <img src="{{ asset('img/bg/bg1.jpeg') }}" alt="PT Johen Sukses Abadi Resmi Berdiri">
                <div class="berita-overlay"></div>
                <div class="berita-hover-top"></div>
                <div class="berita-hover-bottom"></div>
                <div class="berita-info">
                    <h3>PT Johen Sukses Abadi Resmi Berdiri</h3>
                    <div class="berita-date">📅 18 Mei 2025</div>
                </div>
                <div class="berita-desc">Perusahaan digital gaming commerce resmi hadir sebagai solusi terpercaya di Indonesia.</div>
            </div>
            <div class="berita-card">
                <img src="{{ asset('img/bg/bg2.jpeg') }}" alt="Tips Aman Jual Beli Akun Game">
                <div class="berita-overlay"></div>
                <div class="berita-hover-top"></div>
                <div class="berita-hover-bottom"></div>
                <div class="berita-info">
                    <h3>Tips Aman Jual Beli Akun Game</h3>
                    <div class="berita-date">📅 20 Mei 2025</div>
                </div>
                <div class="berita-desc">Panduan bertransaksi akun game dengan aman dari tim Johen Gaming.</div>
            </div>
            <div class="berita-card">
                <img src="{{ asset('img/bg/bg1.jpeg') }}" alt="Live Commerce Hadir">
                <div class="berita-overlay"></div>
                <div class="berita-hover-top"></div>
                <div class="berita-hover-bottom"></div>
                <div class="berita-info">
                    <h3>Live Commerce Hadir</h3>
                    <div class="berita-date">📅 22 Mei 2025</div>
                </div>
                <div class="berita-desc">Pengalaman belanja lebih interaktif melalui live streaming gaming.</div>
            </div>
            <div class="berita-card">
                <img src="{{ asset('img/bg/bg2.jpeg') }}" alt="Lowongan Kerja Terbaru">
                <div class="berita-overlay"></div>
                <div class="berita-hover-top"></div>
                <div class="berita-hover-bottom"></div>
                <div class="berita-info">
                    <h3>Lowongan Kerja Terbaru</h3>
                    <div class="berita-date">📅 25 Mei 2025</div>
                </div>
                <div class="berita-desc">Johen Gaming membuka posisi baru untuk tim profesional.</div>
            </div>
            <div class="berita-card">
                <img src="{{ asset('img/bg/bg1.jpeg') }}" alt="PT Johen Sukses Abadi Resmi Berdiri">
                <div class="berita-overlay"></div>
                <div class="berita-hover-top"></div>
                <div class="berita-hover-bottom"></div>
                <div class="berita-info">
                    <h3>PT Johen Sukses Abadi Resmi Berdiri</h3>
                    <div class="berita-date">📅 18 Mei 2025</div>
                    <div class="berita-desc">Perusahaan digital gaming commerce resmi hadir sebagai solusi terpercaya di Indonesia.</div>
                </div>
            </div>
            <div class="berita-card">
                <img src="{{ asset('img/bg/bg2.jpeg') }}" alt="Tips Aman Jual Beli Akun Game">
                <div class="berita-overlay"></div>
                <div class="berita-hover-top"></div>
                <div class="berita-hover-bottom"></div>
                <div class="berita-info">
                    <h3>Tips Aman Jual Beli Akun Game</h3>
                    <div class="berita-date">📅 20 Mei 2025</div>
                </div>
                <div class="berita-desc">Panduan bertransaksi akun game dengan aman dari tim Johen Gaming.</div>
            </div>
        </div>
    </div>
</section>

{{-- TESTIMONIAL --}}
<section class="section testimoni-section">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="section-title">Apa Kata Mereka?</h2>
            <p class="section-subtitle">Testimoni dari mereka yang telah mengalami langsung manfaatnya.</p>
        </div>
        <div class="testimoni-carousel-wrap">
            <div class="testimoni-track" id="testimoniTrack">
                <div class="testimoni-slide" data-index="0">
                    <div class="ts-avatar">
                        <div class="ts-avatar-img" style="background:#e74c3c;">FF</div>
                        <div>
                            <div class="ts-name">User Free Fire</div>
                            <div class="ts-label">Top Up &mdash; Free Fire</div>
                        </div>
                    </div>
                    <div class="ts-text">Top up Diamond Free Fire di sini cepat banget. Setelah pembayaran berhasil, diamond langsung masuk ke akun tanpa perlu menunggu lama.</div>
                </div>
                <div class="testimoni-slide" data-index="1">
                    <div class="ts-avatar">
                        <div class="ts-avatar-img" style="background:#2ecc71;">ML</div>
                        <div>
                            <div class="ts-name">User Mobile Legends</div>
                            <div class="ts-label">Top Up &mdash; Mobile Legends</div>
                        </div>
                    </div>
                    <div class="ts-text">Top up Diamond MLBB cuma beberapa menit langsung masuk. Harganya juga lebih murah dibanding tempat lain. Sudah langganan dari lama dan selalu aman.</div>
                </div>
                <div class="testimoni-slide" data-index="2">
                    <div class="ts-avatar">
                        <div class="ts-avatar-img" style="background:#f39c12;">PM</div>
                        <div>
                            <div class="ts-name">User PUBG Mobile</div>
                            <div class="ts-label">Top Up &mdash; PUBG Mobile</div>
                        </div>
                    </div>
                    <div class="ts-text">Top up UC PUBG Mobile cuma hitungan menit langsung masuk ke akun. Harganya bersaing, prosesnya cepat, dan sejauh ini selalu aman tanpa kendala. Sudah beberapa kali top up di sini dan hasilnya selalu memuaskan.</div>
                </div>
                <div class="testimoni-slide" data-index="3">
                    <div class="ts-avatar">
                        <div class="ts-avatar-img" style="background:#9b59b6;">VR</div>
                        <div>
                            <div class="ts-name">User Valorant</div>
                            <div class="ts-label">Top Up &mdash; Valorant</div>
                        </div>
                    </div>
                    <div class="ts-text">Top up Valorant Points di sini prosesnya cepat dan aman. Metode pembayarannya lengkap, cocok untuk top up rutin setiap season.</div>
                </div>
                <div class="testimoni-slide" data-index="4">
                    <div class="ts-avatar">
                        <div class="ts-avatar-img" style="background:#1abc9c;">GI</div>
                        <div>
                            <div class="ts-name">User Genshin Impact</div>
                            <div class="ts-label">Top Up &mdash; Genshin Impact</div>
                        </div>
                    </div>
                    <div class="ts-text">Top up Genesis Crystal Genshin Impak dijamin aman dan cepat. Harga kompetitif, pelayanan ramah, dan selalu ada promo menarik setiap minggunya. Recommended.</div>
                </div>
            </div>
        </div>
        <div class="testimoni-dots" id="testimoniDots"></div>
    </div>
</section>

{{-- PAYMENT MARQUEE + CTA --}}
<section class="payment-section">
    <div class="payment-marquee">
        <div class="marquee-track">
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bri.png') }}" alt="BRI" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bni.png') }}" alt="BNI" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bca.png') }}" alt="BCA" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/mandiri.png') }}" alt="Mandiri" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/Gopay.png') }}" alt="GoPay" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/ovo.png') }}" alt="OVO" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/dana.png') }}" alt="DANA" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/shopeepay.png') }}" alt="ShopeePay" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/freefire.png') }}" alt="Free Fire" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/mobile-legend.png') }}" alt="Mobile Legend" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/pubg.png') }}" alt="PUBG" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/valorant.png') }}" alt="Valorant" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/roblox.png') }}" alt="Roblox" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/efootball.png') }}" alt="Efootball" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bri.png') }}" alt="BRI" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bni.png') }}" alt="BNI" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/bca.png') }}" alt="BCA" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/mandiri.png') }}" alt="Mandiri" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/Gopay.png') }}" alt="GoPay" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/ovo.png') }}" alt="OVO" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/dana.png') }}" alt="DANA" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/shopeepay.png') }}" alt="ShopeePay" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/freefire.png') }}" alt="Free Fire" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/mobile-legend.png') }}" alt="Mobile Legend" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/pubg.png') }}" alt="PUBG" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/valorant.png') }}" alt="Valorant" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/roblox.png') }}" alt="Roblox" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
            <a href="#" class="pay-logo" style="background:none;padding:0;"><img src="{{ asset('img/logo/efootball.png') }}" alt="Efootball" style="height:32px;width:auto;object-fit:contain;display:block;"></a>
        </div>
    </div>
    <div class="cta-bottom">
        <div class="container">
            <h2>Siap Meningkatkan Pengalaman Gaming-mu?</h2>
            <p>Top up lebih cepat, joki lebih aman, dan jual beli akun dengan proses transparan serta terpercaya.</p>
            <a href="{{ route('kontak') }}" class="btn-hubungi">
                <span class="btn-icon-wrap">📞</span>
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
    const slides = document.querySelectorAll('.hero-bg-slide');
    const overlayLeft = document.getElementById('heroOverlayLeft');
    let current = 0;

    setInterval(() => {
        const next = (current + 1) % slides.length;
        slides[current].classList.remove('active');
        overlayLeft.classList.remove('active');
        setTimeout(() => {
            slides[next].classList.add('active');
            overlayLeft.classList.add('active');
            current = next;
        }, 2000);
    }, 8000);
</script>
<script>
(function() {
    var track = document.getElementById('testimoniTrack');
    var slides = Array.from(track.querySelectorAll('.testimoni-slide'));
    var total = slides.length;
    var dotsContainer = document.getElementById('testimoniDots');
    var centerIndex = 0;
    var animating = false;

    var gap = 320;
    if (window.innerWidth <= 768) gap = 230;
    if (window.innerWidth <= 480) gap = 195;

    function render() {
        slides.forEach(function(el, i) {
            var rawPos = (i - centerIndex + total) % total;
            if (rawPos > 2) rawPos -= total;

            var tX, tY, s, o, z;
            if (rawPos === -2) {
                tX = -(gap * 2); tY = '20px'; s = 0.7; o = 0; z = 1;
            } else if (rawPos === -1) {
                tX = -gap; tY = '20px'; s = 0.85; o = 0.5; z = 5;
            } else if (rawPos === 0) {
                tX = 0; tY = '0'; s = 1; o = 1; z = 10;
            } else if (rawPos === 1) {
                tX = gap; tY = '20px'; s = 0.85; o = 0.5; z = 5;
            } else {
                tX = gap * 2; tY = '20px'; s = 0.7; o = 0; z = 1;
            }

            el.style.transform = 'translateX(calc(-50% + ' + tX + 'px)) translateY(' + tY + ') scale(' + s + ')';
            el.style.opacity = o;
            el.style.zIndex = z;
        });

        var dots = dotsContainer.querySelectorAll('.tdot');
        for (var i = 0; i < dots.length; i++) {
            dots[i].classList.toggle('active', i === centerIndex);
        }
    }

    function goTo(index) {
        if (animating) return;
        animating = true;
        centerIndex = (index + total) % total;
        render();
        setTimeout(function() { animating = false; }, 500);
    }

    function next() { goTo(centerIndex + 1); }
    function prev() { goTo(centerIndex - 1); }

    for (var i = 0; i < total; i++) {
        (function(idx) {
            var slide = slides[i];
            slide.addEventListener('click', function() {
                if (idx !== centerIndex) goTo(idx);
            });
        })(i);
    }

    for (var i = 0; i < total; i++) {
        (function(idx) {
            var dot = document.createElement('button');
            dot.className = 'tdot';
            dot.addEventListener('click', function() { goTo(idx); });
            dotsContainer.appendChild(dot);
        })(i);
    }

    goTo(0);

    var autoplay = setInterval(next, 5000);
    track.addEventListener('mouseenter', function() { clearInterval(autoplay); });
    track.addEventListener('mouseleave', function() {
        autoplay = setInterval(next, 5000);
    });

    // Drag / swipe support
    var startX = 0, dragging = false;
    track.addEventListener('mousedown', function(e) { startX = e.clientX; dragging = true; });
    track.addEventListener('mousemove', function(e) { if (dragging) e.preventDefault(); });
    track.addEventListener('mouseup', function(e) {
        if (!dragging) return;
        dragging = false;
        var diff = e.clientX - startX;
        if (Math.abs(diff) > 40) diff > 0 ? prev() : next();
    });
    track.addEventListener('mouseleave', function() { dragging = false; });

    track.addEventListener('touchstart', function(e) { startX = e.touches[0].clientX; }, {passive: true});
    track.addEventListener('touchmove', function(e) { e.preventDefault(); }, {passive: false});
    track.addEventListener('touchend', function(e) {
        var diff = e.changedTouches[0].clientX - startX;
        if (Math.abs(diff) > 40) diff > 0 ? prev() : next();
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth <= 480) gap = 195;
        else if (window.innerWidth <= 768) gap = 230;
        else gap = 320;
        render();
    });
})();
</script>
@endpush
