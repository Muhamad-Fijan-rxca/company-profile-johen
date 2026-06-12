@extends('layouts.app')
@section('title', 'Tentang Kami')

@push('styles')
<style>
    /* ── HERO ── */
    .about-hero {
        min-height: 55vh;
        display: flex; align-items: center; justify-content: center;
        position: relative; overflow: hidden;
        background: #020D2E;
        padding: 110px 24px 80px;
    }
    .about-hero-bg {
        position: absolute; inset: 0; z-index: 0;
        background: url('{{ asset("img/bg/bg1.jpeg") }}') center/cover no-repeat;
        opacity: 0.3;
    }
    .about-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg,
            rgba(1,32,60,0.85) 0%,
            rgba(5,42,72,0.75) 45%,
            rgba(10,48,80,0.80) 100%
        );
        z-index: 1;
    }
    .about-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 720px;
    }
    .about-hero-content h1 {
        font-size: clamp(40px, 5.5vw, 62px);
        font-weight: 900;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
        background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        filter: drop-shadow(0 0 20px rgba(26,140,255,0.3)) drop-shadow(0 0 40px rgba(124,58,237,0.15));
    }
    .about-hero-content p {
        font-size: 18px;
        color: rgba(255,255,255,0.85);
        line-height: 1.8;
        max-width: 580px;
        margin: 0 auto;
        text-shadow: 0 4px 20px rgba(0,0,0,0.5), 0 0 30px rgba(0,212,255,0.1);
    }

    /* ── PROFIL ── */
    .profil-section {
        background: #020D2E;
        position: relative; overflow: hidden;
        padding: 120px 0;
    }
    .profil-section::after {
        content: ''; position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='1440' height='300' viewBox='0 0 1440 300' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 150 Q 360 300 720 150 T 1440 150' fill='none' stroke='rgba(0,212,255,0.05)' stroke-width='2'/%3E%3C/svg%3E") repeat-x bottom;
        background-size: 1440px auto;
        pointer-events: none;
        opacity: 0.6;
        z-index: 1;
    }
    .profil-section .container {
        display: grid;
        grid-template-columns: 52fr 48fr;
        gap: 100px;
        align-items: center;
        position: relative; z-index: 2;
    }
    .profil-foto {
        border-radius: 20px; overflow: hidden;
        aspect-ratio: 4/3;
        box-shadow: 0 24px 64px rgba(0,0,0,0.4), 0 0 0 1px rgba(0,212,255,0.1);
        position: relative;
        transition: transform 0.5s cubic-bezier(0.4,0,0.2,1), box-shadow 0.5s cubic-bezier(0.4,0,0.2,1);
    }
    .profil-foto:hover {
        transform: scale(1.03);
        box-shadow: 0 32px 80px rgba(0,212,255,0.2), 0 0 0 2px rgba(0,212,255,0.3);
    }
    .profil-foto::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(0,212,255,0.15) 0%, transparent 60%);
        pointer-events: none;
    }
    .profil-foto img {
        width: 100%; height: 100%; object-fit: cover;
        display: block;
        transition: transform 0.6s cubic-bezier(0.4,0,0.2,1);
    }
    .profil-foto:hover img {
        transform: scale(1.08);
    }
    .profil-teks h2 {
        font-size: clamp(28px, 3vw, 38px);
        font-weight: 900;
        margin-bottom: 24px;
        white-space: nowrap;
        background: linear-gradient(90deg, #1a8cff, #7c3aed, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .profil-teks p {
        font-size: 14px;
        color: rgba(255,255,255,0.75);
        line-height: 1.75;
        margin-bottom: 16px;
    }

    /* ── TIMELINE ── */
    .timeline-section {
        background: #020D2E;
        padding: 80px 0 120px;
        position: relative;
    }
    .timeline-header {
        text-align: center;
        margin-bottom: 48px;
    }
    .timeline-header h2 {
        font-size: clamp(28px, 3.5vw, 42px);
        font-weight: 800;
        color: white;
        margin-bottom: 12px;
    }
    .timeline-header p {
        font-size: 15px;
        color: rgba(255,255,255,0.5);
    }
    .timeline-wrap {
        position: relative;
        max-width: 900px;
        margin: 0 auto;
    }

    /* Center vertical line */
    .tl-line {
        position: absolute;
        top: 0; bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        background: rgba(255,255,255,0.2);
        z-index: 1;
    }

    /* Each timeline row — 3-column grid */
    .tl-row {
        display: grid;
        grid-template-columns: 1fr 40px 1fr;
        position: relative;
        z-index: 2;
        margin-bottom: 40px;
    }
    .tl-row:last-child { margin-bottom: 0; }

    /* Left / right content columns */
    .tl-col-left,
    .tl-col-right {
        display: flex;
        align-items: flex-start;
        position: relative;
        padding-top: 10px;
    }
    .tl-col-left  { justify-content: flex-end; }
    .tl-col-right { justify-content: flex-start; }

    /* Center column — holds the node circle */
    .tl-col-center {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        position: relative;
        padding-top: 10px;
    }

    /* Circle node on the center line */
    .tl-node {
        width: 18px; height: 18px;
        border-radius: 50%;
        background: #1E1B4B;
        border: 3px solid #7C3AED;
        box-sizing: content-box;
        position: relative;
        z-index: 3;
        flex-shrink: 0;
    }

    /* Connecting horizontal line (from node toward date badge) */
    .tl-connector {
        position: absolute;
        top: 21px;
        width: 20px;
        height: 2px;
        background: rgba(124,58,237,0.4);
    }
    .tl-date-left .tl-connector {
        right: 0;
        left: auto;
    }
    .tl-date-right .tl-connector {
        left: 0;
        right: auto;
    }

    /* Date badge */
    .tl-date {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 100px;
        background: #7C3AED;
        color: white;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        white-space: nowrap;
        position: relative;
        z-index: 2;
    }

    /* Description card */
    .tl-card {
        width: 100%;
        max-width: 380px;
    }
    .tl-card-inner {
        background: linear-gradient(135deg, #1E3A8A, #6D28D9);
        border-radius: 14px;
        padding: 20px 28px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .tl-card-inner:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.3);
    }
    .tl-card-inner h4 {
        font-size: 16px;
        font-weight: 700;
        color: white;
        margin-bottom: 8px;
    }
    .tl-card-inner p {
        font-size: 14px;
        color: rgba(255,255,255,0.65);
        line-height: 1.6;
        margin: 0;
    }

    /* Date on left → card on right */
    .tl-date-left .tl-col-left {
        padding-right: 8px;
    }
    .tl-date-left .tl-col-right {
        padding-left: 20px;
    }

    /* Date on right → card on left */
    .tl-date-right .tl-col-left {
        padding-right: 20px;
    }
    .tl-date-right .tl-col-right {
        padding-left: 8px;
    }

    /* Item 2 card left-aligned */
    .tl-date-right .tl-card-inner { text-align: left; }

    /* ── VISI & MISI ── */
    .vm-section {
        background: #041640;
        padding: 80px 0 120px;
        position: relative;
    }
    .vm-header {
        text-align: center;
        margin-bottom: 48px;
    }
    .vm-header h2 {
        font-size: clamp(28px, 3.5vw, 42px);
        font-weight: 800;
        color: white;
        margin-bottom: 12px;
    }
    .vm-header p {
        font-size: 15px;
        color: rgba(255,255,255,0.5);
        max-width: 600px;
        margin: 0 auto;
    }
    .vm-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        max-width: 1400px;
        margin: 0 auto;
    }
    .vm-card {
        position: relative;
        background: #0A1E50;
        border: 1px solid rgba(30, 58, 138, 0.4);
        border-radius: 20px;
        padding: 52px 44px 44px;
        overflow: visible;
        margin-top: 18px;
        display: flex;
        flex-direction: column;
    }
    .vm-body {
        flex: 1;
        color: white;
    }
    .vm-tab {
        position: absolute;
        top: -16px;
        padding: 6px 28px;
        font-weight: 700;
        font-size: 13px;
        color: white;
        text-align: center;
        z-index: 2;
        letter-spacing: 1px;
    }
    .visi-tab {
        left: 24px;
        background: #1E3A8A;
        clip-path: polygon(0 0, calc(100% - 14px) 0, 100% 100%, 0 100%);
    }
    .misi-tab {
        right: 24px;
        background: #6D28D9;
        clip-path: polygon(14px 0, 100% 0, 100% 100%, 0 100%);
    }
    .vm-body p {
        font-size: 16px;
        line-height: 1.6;
        color: rgba(255,255,255,0.8);
        margin: 0;
    }
    .vm-body ol {
        margin: 0;
        padding-left: 24px;
        list-style-position: outside;
    }
    .vm-body ol li {
        font-size: 16px;
        line-height: 1.6;
        color: rgba(255,255,255,0.8);
        margin-bottom: 10px;
    }
    .vm-body ol li:last-child { margin-bottom: 0; }

    /* ── KENAPA MEMILIH KAMI ── */
    .why-section {
        background: #020D2E;
        padding: 80px 0 120px;
        position: relative;
    }
    .why-header {
        text-align: center;
        margin-bottom: 48px;
    }
    .why-header h2 {
        font-size: clamp(26px, 3.2vw, 38px);
        font-weight: 700;
        color: white;
        margin-bottom: 12px;
        line-height: 1.3;
    }
    .why-header .why-white {
        color: white;
    }
    .why-header .why-highlight {
        background: linear-gradient(90deg, #0987F5, #854DEA);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .why-header p {
        font-size: 15px;
        color: rgba(255,255,255,0.5);
        max-width: 800px;
        margin: 0 auto;
    }

    .why-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 35px;
        max-width: 900px;
        margin: 0 auto;
    }

    .why-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 22px 30px;
        border-radius: 14px;
        background: linear-gradient(145deg, rgba(133,77,234,0.75), #005096);
        box-shadow:
            inset 0 3px 8px rgba(0,0,0,0.5),
            inset 0 12px 28px rgba(0,0,0,0.25);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .why-card:hover {
        transform: translateY(-4px);
        box-shadow:
            inset 0 3px 10px rgba(0,0,0,0.55),
            inset 0 16px 36px rgba(0,0,0,0.3);
    }

    .why-icon {
        width: 32px;
        height: 32px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .why-label {
        color: white;
        font-weight: 400;
        font-size: 17px;
        white-space: nowrap;
    }

    /* ── KANTOR PUSAT ── */
    .kantor-section {
        background: #041640;
        padding: 80px 0 120px;
        position: relative;
    }

    .kantor-grid {
        display: grid;
        grid-template-columns: 2fr 2fr;
        gap: 95px;
        max-width: 1100px;
        margin: 0 auto;
        align-items: start;
    }

    /* ── Left column ── */
    .kantor-left h2 {
        font-size: clamp(28px, 3.5vw, 42px);
        font-weight: 800;
        color: white;
        margin-bottom: 10px;
    }
    .kantor-left > p {
        font-size: 14px;
        color: rgba(255,255,255,0.55);
        margin-bottom: 24px;
        line-height: 1.6;
    }

    .kantor-map {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        aspect-ratio: 16 / 8.5;
        margin-top: 28px;
    }
    .kantor-map iframe {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    .kantor-fullscreen {
        position: absolute;
        bottom: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        background: rgba(0,0,0,0.65);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
        z-index: 2;
    }
    .kantor-fullscreen:hover {
        background: rgba(0,0,0,0.85);
    }
    .kantor-fullscreen svg {
        width: 18px;
        height: 18px;
        fill: white;
    }

    /* ── Right column ── */
    .kantor-right {
        display: flex;
        flex-direction: column;
    }
    .kantor-right > * + * {
        margin-top: 30px;
    }
    .kantor-alamat {
        margin-bottom: 16px;
    }

    .kantor-alamat {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        background: linear-gradient(135deg, rgba(9, 135, 245, 0.3), rgba(133, 77, 234, 0.3));
        border-radius: 16px;
        padding: 20px 24px;
    }
    .kantor-alamat-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .kantor-alamat-icon svg {
        width: 22px;
        height: 22px;
        fill: white;
    }
    .kantor-alamat-text {
        color: white;
        font-size: 14px;
        line-height: 1.6;
    }

    .kantor-contact {
        display: flex;
        align-items: center;
        gap: 16px;
        background: rgba(13,27,62,0.7);
        border: 2px solid #004786;
        border-radius: 14px;
        padding: 16px 20px;
    }
    .kantor-contact + .kantor-contact {
        margin-top: 20px;
    }
    .kantor-contact-icon {
        position: relative;
        width: 44px;
        height: 44px;
        border-radius: 8px;
        background: #00325F;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
        color: white;
    }
    .kantor-contact-icon::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 10px;
        padding: 1.5px;
        background: linear-gradient(135deg, #0987F5, #854DEA);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }
    .kantor-contact span {
        color: white;
        font-size: 14px;
        font-weight: 500;
    }

    /* ── KIRIM PESAN KE CS ── */
    .cs-section {
        background: #020D2E;
        padding: 80px 0 120px;
        position: relative;
    }
    .cs-header {
        text-align: center;
        margin-bottom: 48px;
    }
    .cs-header h2 {
        font-size: clamp(28px, 3.5vw, 42px);
        font-weight: 800;
        color: white;
        margin-bottom: 12px;
    }
    .cs-header p {
        font-size: 15px;
        color: rgba(255,255,255,0.5);
        max-width: 600px;
        margin: 0 auto;
    }

    .cs-card {
        max-width: 680px;
        margin: 0 auto;
        background: #0D1B3E;
        border: 2px solid #004786;
        border-radius: 20px;
        padding: 42px 38px;
    }

    /* Info bar CS */
    .cs-info {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        background: #0A1E50;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 28px;
        position: relative;
    }
    .cs-info::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 12px;
        padding: 2px;
        background: linear-gradient(135deg, rgba(9, 135, 245, 0.6), rgba(133, 77, 234, 0.6));
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }
    .cs-info-icon {
        position: relative;
        width: 44px;
        height: 44px;
        background: #00325F;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .cs-info-icon::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 10px;
        padding: 1.5px;
        background: linear-gradient(135deg, #0987F5, #854DEA);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }
    .cs-info-icon svg {
        width: 20px;
        height: 20px;
        fill: white;
    }
    .cs-info-body {
        flex: 1;
        min-width: 0;
    }
    .cs-info-name {
        font-size: 13px;
        font-weight: 700;
        color: white;
        margin-bottom: 6px;
    }
    .cs-info-contact {
        display: flex;
        flex-wrap: wrap;
        gap: 12px 20px;
        font-size: 12px;
        color: rgba(255,255,255,0.6);
    }
    .cs-info-contact span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    /* Fields */
    .cs-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .cs-row {
        margin-top: 26px;
    }
    .cs-field {
        display: flex;
        flex-direction: column;
    }
    .cs-field label {
        font-size: 13px;
        font-weight: 600;
        color: white;
        margin-bottom: 6px;
    }
    .cs-field input,
    .cs-field textarea {
        background: #07122A;
        border: 2px solid #004786;
        border-radius: 10px;
        padding: 12px 16px;
        color: white;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
    }
    .cs-field input::placeholder,
    .cs-field textarea::placeholder {
        color: rgba(255,255,255,0.3);
    }
    .cs-field input:focus,
    .cs-field textarea:focus {
        border-color: #4F46E5;
    }
    .cs-field textarea {
        resize: vertical;
        min-height: 140px;
    }

    /* Submit */
    .cs-submit {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 24px;
        padding: 14px 24px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563EB, #7C3AED);
        color: white;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: opacity 0.2s;
    }
    .cs-submit:hover {
        opacity: 0.9;
    }
    .cs-submit svg {
        width: 16px;
        height: 16px;
        fill: white;
        flex-shrink: 0;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 768px) {
        .about-hero { min-height: 45vh; padding: 80px 20px 60px; }
        .profil-section .container { grid-template-columns: 1fr; gap: 48px; }
        .profil-section { padding: 64px 0; }
        .timeline-section { padding: 48px 0 80px; }
        .tl-line { left: 20px; }
        .tl-row {
            grid-template-columns: 1fr;
            gap: 0;
            margin-bottom: 28px;
        }
        .tl-col-left,
        .tl-col-right,
        .tl-col-center {
            padding: 0 !important;
            justify-content: flex-start;
        }
        .tl-col-left  { padding-left: 44px !important; }
        .tl-col-center { order: -1; position: absolute; left: 11px; top: 0; padding-top: 8px; }
        .tl-col-right { padding-left: 44px !important; }
        .tl-date-left .tl-col-left  { order: 1; }
        .tl-date-left .tl-col-right { order: 2; }
        .tl-date-right .tl-col-left  { order: 2; }
        .tl-date-right .tl-col-right { order: 1; }
        .tl-date-left .tl-col-left { margin-top: 8px; }
        .tl-date-right .tl-col-right { margin-top: 8px; }
        .tl-connector { display: none; }
        .tl-card { max-width: 100%; }
        .tl-card-inner { padding: 14px 18px; }
        .tl-date { font-size: 12px; padding: 5px 14px; }
        .tl-date-right .tl-card-inner { text-align: left; }
        .why-section { padding: 48px 0 80px; }
        .why-grid { grid-template-columns: 1fr; gap: 16px; max-width: 400px; }
        .why-card { padding: 16px 20px; }
        .why-label { font-size: 14px; }
        .vm-section { padding: 48px 0 80px; }
        .vm-grid { grid-template-columns: 1fr; gap: 40px; }
    }
    @media (max-width: 480px) {
        .about-hero { min-height: 38vh; padding: 60px 16px 40px; }
        .tl-row { margin-bottom: 24px; }
        .tl-card-inner { padding: 12px 16px; }
        .tl-col-left,
        .tl-col-right { padding-left: 40px !important; }
        .tl-col-center { left: 9px; }
        .kantor-section { padding: 48px 0 80px; }
        .kantor-grid { grid-template-columns: 1fr; gap: 32px; }
        .cs-section { padding: 48px 0 80px; }
        .cs-card { padding: 24px 20px; }
        .cs-row-2 { grid-template-columns: 1fr; }
        .why-icon { width: 30px; height: 30px; font-size: 13px; }
        .why-label { font-size: 13px; white-space: normal; }
        .vm-card { padding: 32px 20px 24px; }
        .visi-tab { left: 16px; }
        .misi-tab { right: 16px; }
    }
</style>
@endpush

@section('content')
{{-- SECTION 1 — HERO --}}
<section class="about-hero">
    <div class="about-hero-bg"></div>
    <div class="about-hero-content">
        <h1>Tentang Kami</h1>
        <p>Perusahaan digital gaming commerce terpercaya di Bandung.<br>Melayani kebutuhan gaming Anda dengan standar keamanan tertinggi.</p>
    </div>
</section>

{{-- SECTION 2 — PROFIL PERUSAHAAN --}}
<section class="profil-section">
    <div class="container">
        <div class="profil-foto">
            <img src="{{ asset('img/figma/about-team.jpg') }}" alt="Tim Johen Gaming">
        </div>
        <div class="profil-teks">
            <h2>PT. JOHEN SUKSES ABADI</h2>
            <p>Johen adalah perusahaan startup yang bergerak di bidang <strong>digital gaming commerce</strong> dan pengembangan ekosistem bisnis berbasis industri game online di Indonesia. Berdiri sejak tahun <strong>2022</strong>, perusahaan hadir sebagai solusi terpercaya dalam menyediakan berbagai layanan kebutuhan pemain game dan komunitas digital. Bermarkas di <strong>Kota Bandung</strong>, Jawa Barat, Johen Gaming terus berinovasi mengembangkan bisnis yang aman, profesional, dan berkelanjutan.</p>
            <p>Fokus bisnis kami meliputi <strong>jual beli akun game online</strong> (PUBG Mobile, Mobile Legends, Free Fire, Roblox, eFootball, dan game lainnya), <strong>top up game</strong>, <strong>jasa joki game</strong>, <strong>live commerce gaming</strong>, serta <strong>pengelolaan konten digital</strong>. Johen berkomitmen membangun ekosistem bisnis yang inovatif dan berorientasi pada kepuasan pelanggan.</p>
            <p>Dengan kantor operasional di <strong>Ruko Topaz No 60, Summarecon Bandung</strong>, Johen Gaming siap melayani seluruh gamer Indonesia. Kami terus mengembangkan layanan dan memperluas jangkauan untuk memberikan pengalaman terbaik bagi setiap pelanggan. Johen — solusi lengkap untuk kebutuhan gaming Anda, dari hobi menjadi kebanggaan.</p>
        </div>
    </div>
</section>

{{-- SECTION 3 — TIMELINE --}}
<section class="timeline-section">
    <div class="container">
        <div class="timeline-header">
            <h2>Perjalanan Perusahaan</h2>
            <p>Setiap langkah adalah bagian dari perjalanan menuju layanan gaming terbaik di Indonesia.</p>
        </div>
        <div class="timeline-wrap">
            <div class="tl-line"></div>

            {{-- ITEM 1: Date left — Card right --}}
            <div class="tl-row tl-date-left">
                <div class="tl-col-left">
                    <div class="tl-connector"></div>
                    <span class="tl-date">Januari 2022</span>
                </div>
                <div class="tl-col-center">
                    <div class="tl-node"></div>
                </div>
                <div class="tl-col-right">
                    <div class="tl-card">
                        <div class="tl-card-inner">
                            <h4>Pendirian PT. Johen Sukses Abadi</h4>
                            <p>Berdiri sebagai perusahaan digital gaming commerce yang berfokus pada jual beli akun game online dan top up game.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ITEM 2: Date right — Card left --}}
            <div class="tl-row tl-date-right">
                <div class="tl-col-left">
                    <div class="tl-card">
                        <div class="tl-card-inner">
                            <h4>Pengembangan Layanan Live Commerce</h4>
                            <p>Meluncurkan live streaming penjualan dan produksi konten digital gaming untuk jangkauan lebih luas.</p>
                        </div>
                    </div>
                </div>
                <div class="tl-col-center">
                    <div class="tl-node"></div>
                </div>
                <div class="tl-col-right">
                    <div class="tl-connector"></div>
                    <span class="tl-date">Januari 2024</span>
                </div>
            </div>

            {{-- ITEM 3: Date left — Card right --}}
            <div class="tl-row tl-date-left">
                <div class="tl-col-left">
                    <div class="tl-connector"></div>
                    <span class="tl-date">Januari 2025</span>
                </div>
                <div class="tl-col-center">
                    <div class="tl-node"></div>
                </div>
                <div class="tl-col-right">
                    <div class="tl-card">
                        <div class="tl-card-inner">
                            <h4>Ekspansi Divisi Store & Tim Profesional</h4>
                            <p>Mengembangkan divisi store (Johen MLBB, Johen Roblox, Johen PUBG, Monkey PUBG) dan memperkuat tim profesional dengan struktur organisasi lengkap.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4 — VISI & MISI --}}
<section class="vm-section">
    <div class="container">
        <div class="vm-header">
            <h2>Arah dan Tujuan Kami</h2>
            <p>Menghadirkan layanan gaming yang aman, cepat, dan terpercaya untuk mendukung pengalaman bermain yang lebih nyaman.</p>
        </div>
        <div class="vm-grid">
            <div class="vm-card">
                <div class="vm-tab visi-tab">VISI</div>
                <div class="vm-body">
                    <p>Menjadi perusahaan no 1 di Bandung dan Indonesia sebagai pusat jual beli akun semua game online yang terpercaya, dengan pelayanan terbaik dan standar keamanan akun terbaik, serta menjadi pelopor utama industri gaming commerce di tingkat nasional dan internasional</p>
                </div>
            </div>
            <div class="vm-card">
                <div class="vm-tab misi-tab">MISI</div>
                <div class="vm-body">
                    <ol>
                        <li>Memberikan layanan terbaik kepada pelanggan.</li>
                        <li>Menjaga dan meningkatkan standar keamanan akun.</li>
                        <li>Mengembangkan live commerce dan konten digital.</li>
                        <li>Membangun tim yang profesional, disiplin, dan berintegritas.</li>
                        <li>Mengembangkan bisnis yang inovatif dan berkelanjutan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5 — KENAPA MEMILIH KAMI --}}
<section class="why-section">
    <div class="container">
        <div class="why-header">
            <h2>
                <span class="why-white">Kenapa Memilih Kami?</span>
                <span class="why-highlight"> Ini yang Membuat</span>
                <br>
                <span class="why-highlight">Kami Berbeda</span>
            </h2>
            <p>Memberikan layanan game terpercaya dengan proses cepat, aman, dan transparan untuk setiap transaksi.</p>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <img src="{{ asset('img/icon/centang.png') }}" class="why-icon" alt="">
                <span class="why-label">Sistem Kerja Terstruktur</span>
            </div>
            <div class="why-card">
                <img src="{{ asset('img/icon/centang.png') }}" class="why-icon" alt="">
                <span class="why-label">Tim Berpengalaman</span>
            </div>
            <div class="why-card">
                <img src="{{ asset('img/icon/centang.png') }}" class="why-icon" alt="">
                <span class="why-label">Standar Keamanan Akun Terbaik</span>
            </div>
            <div class="why-card">
                <img src="{{ asset('img/icon/centang.png') }}" class="why-icon" alt="">
                <span class="why-label">Kantor Operasional Fisik</span>
            </div>
            <div class="why-card">
                <img src="{{ asset('img/icon/centang.png') }}" class="why-icon" alt="">
                <span class="why-label">Pelayanan Cepat dan Responsif</span>
            </div>
            <div class="why-card">
                <img src="{{ asset('img/icon/centang.png') }}" class="why-icon" alt="">
                <span class="why-label">Fokus Kepuasan Pelanggan</span>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 6 — KANTOR PUSAT --}}
<section class="kantor-section">
    <div class="container">
        <div class="kantor-grid">
            <div class="kantor-left">
                <h2>Kantor Pusat</h2>
                <p>Kunjungi kantor operasional kami di Summarecon Bandung atau melalui kontak dibawah ini</p>
                <div class="kantor-map">
                    <iframe src="https://www.google.com/maps?q=Johen+Gaming&output=embed&z=17" allowfullscreen loading="lazy"></iframe>
                    <a href="https://www.google.com/maps/place/Johen+Gaming/@-6.9595319,107.6964795,17z" target="_blank" class="kantor-fullscreen" aria-label="Buka peta">
                        <svg viewBox="0 0 24 24"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"/></svg>
                    </a>
                </div>
            </div>
            <div class="kantor-right">
                <div class="kantor-alamat">
                    <div class="kantor-alamat-icon">
                        <img src="{{ asset('img/icon/bangunan.png') }}" alt="Bangunan" style="width: 34px; height: 34px;">
                    </div>
                    <div class="kantor-alamat-text">
                        Ruko Topaz Summarecon Bandung No.60, Cisaranten Kidul, Kec. Gedebage, Kota Bandung, Jawa Barat 40295
                    </div>
                </div>
                <div class="kantor-contact">
                    <div class="kantor-contact-icon"><img src="{{ asset('img/icon/pesan.png') }}" alt="Pesan" style="width: 26px; height: 26px;"></div>
                    <span>corporate@johengaming.store</span>
                </div>
                <div class="kantor-contact">
                    <div class="kantor-contact-icon"><img src="{{ asset('img/icon/wablue.png') }}" alt="WhatsApp" style="width: 26px; height: 26px;"></div>
                    <span>0812-3470-7070</span>
                </div>
                <div class="kantor-contact">
                    <div class="kantor-contact-icon"><img src="{{ asset('img/icon/cs.png') }}" alt="CS" style="width: 26px; height: 26px;"></div>
                    <span>cs@johengaming.store</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 7 — KIRIM PESAN KE CS --}}
<section class="cs-section">
    <div class="container">
        <div class="cs-header">
            <h2>Kirim pesan ke CS</h2>
            <p>Ada pertanyaan, keluhan, atau butuh bantuan? Tim customer service siap membantu anda.</p>
        </div>
        <div class="cs-card">
            {{-- Info bar CS --}}
            <div class="cs-info">
                    <div class="cs-info-icon">
                        <img src="{{ asset('img/icon/cs.png') }}" alt="CS" style="width: 26px; height: 26px;">
                    </div>
                <div class="cs-info-body">
                    <div class="cs-info-name">Customer Service Johen Gaming</div>
                    <div class="cs-info-contact">
                        <span>
                            <svg viewBox="0 0 24 24" width="12" height="12" fill="rgba(255,255,255,0.5)"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/></svg>
                            0812-3470-7070
                        </span>
                        <span>
                            <svg viewBox="0 0 24 24" width="12" height="12" fill="rgba(255,255,255,0.5)"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                            cs@johengaming.store
                        </span>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('kontak.kirim') }}" method="POST">
                @csrf
                <input type="hidden" name="tujuan" value="cs">

                <div class="cs-row-2">
                    <div class="cs-field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Masukan nama lengkap anda" required>
                    </div>
                    <div class="cs-field">
                        <label>Alamat Email</label>
                        <input type="email" name="email" placeholder="Masukan alamat email anda" required>
                    </div>
                </div>

                <div class="cs-row">
                    <div class="cs-field">
                        <label>Nomor Telepon</label>
                        <input type="text" name="no_hp" placeholder="Masukan nomor telepon anda" required>
                    </div>
                </div>

                <div class="cs-row">
                    <div class="cs-field">
                        <label>Subjek</label>
                        <input type="text" name="nama_game" placeholder="Masukan subjek" required>
                    </div>
                </div>

                <div class="cs-row">
                    <div class="cs-field">
                        <label>Pesan atau Keluhan</label>
                        <textarea name="deskripsi" placeholder="Masukan pesan atau keluhan anda secara detail pada kami." required></textarea>
                    </div>
                </div>

                <button type="submit" class="cs-submit">
                    <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
