<?php
/**
 * Plugin Name: GIP APP FACTORY
 * Description: Visual app-building system by Gigi + Gip. Factory library, visual builder and reusable app layouts.
 * Version: 1.0.0
 * Author: Gigi + Gip
 * Text Domain: gip-app-factory
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class GIP_App_Factory_100 {
    const VERSION = '1.0.0';
    const SLUG    = 'gip-app-factory';

    public static function boot() {
        add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );
    }

    public static function activate() {
        update_option( 'gip_app_factory_version', self::VERSION, false );
        if ( ! get_option( 'gip_app_factory_installed_at' ) ) {
            update_option( 'gip_app_factory_installed_at', current_time( 'mysql' ), false );
        }
    }

    public static function admin_menu() {
        add_menu_page(
            'GIP APP FACTORY',
            'GIP APP FACTORY',
            'manage_options',
            self::SLUG,
            array( __CLASS__, 'render_admin' ),
            'dashicons-screenoptions',
            3
        );
    }

    private static function tile( $eyebrow, $title, $copy, $state ) {
        printf(
            '<article class="gaf-tile"><div class="gaf-tile-top"><span>%1$s</span><b>%4$s</b></div><h2>%2$s</h2><p>%3$s</p></article>',
            esc_html( $eyebrow ),
            esc_html( $title ),
            esc_html( $copy ),
            esc_html( $state )
        );
    }

    public static function render_admin() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        ?>
        <div class="wrap gaf-wrap">
            <style>
                .gaf-wrap{max-width:1280px;margin:28px 28px 50px 10px;color:#151515;font-family:Inter,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif}
                .gaf-shell{border-radius:30px;overflow:hidden;background:#f3f1ea;box-shadow:0 20px 70px rgba(15,15,20,.10);border:1px solid rgba(20,20,20,.08)}
                .gaf-hero{position:relative;min-height:330px;padding:42px 44px;background:radial-gradient(circle at 82% 20%,rgba(166,255,76,.28),transparent 28%),linear-gradient(135deg,#111216 0%,#20232b 58%,#101114 100%);color:#fff;overflow:hidden}
                .gaf-hero:after{content:"";position:absolute;right:-80px;bottom:-150px;width:390px;height:390px;border:1px solid rgba(255,255,255,.13);border-radius:48%;box-shadow:0 0 0 50px rgba(255,255,255,.025),0 0 0 100px rgba(255,255,255,.018);transform:rotate(18deg)}
                .gaf-kicker{display:flex;align-items:center;gap:10px;font-size:13px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.66)}
                .gaf-dot{width:9px;height:9px;border-radius:50%;background:#a6ff4c;box-shadow:0 0 18px rgba(166,255,76,.9)}
                .gaf-hero h1{max-width:790px;margin:26px 0 14px;font-size:clamp(44px,5.3vw,78px);line-height:.92;letter-spacing:-.055em;color:#fff}
                .gaf-hero h1 em{font-style:normal;color:#a6ff4c}
                .gaf-hero p{max-width:720px;margin:0;font-size:17px;line-height:1.55;color:rgba(255,255,255,.7)}
                .gaf-status{position:absolute;top:34px;right:38px;z-index:2;display:flex;align-items:center;gap:9px;padding:10px 14px;border:1px solid rgba(255,255,255,.12);border-radius:999px;background:rgba(255,255,255,.07);backdrop-filter:blur(12px);font-size:12px;font-weight:800;letter-spacing:.07em;text-transform:uppercase}
                .gaf-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:1px;background:rgba(20,20,20,.09)}
                .gaf-tile{min-height:230px;padding:28px 27px 30px;background:#f8f7f2;transition:transform .18s ease,background .18s ease}
                .gaf-tile:hover{background:#fff;transform:translateY(-2px)}
                .gaf-tile-top{display:flex;justify-content:space-between;gap:12px;font-size:12px;font-weight:800;letter-spacing:.09em;text-transform:uppercase;color:#777}
                .gaf-tile-top b{color:#678e29}
                .gaf-tile h2{margin:58px 0 10px;font-size:28px;line-height:1;letter-spacing:-.04em}
                .gaf-tile p{margin:0;font-size:15px;line-height:1.55;color:#686868}
                .gaf-next{display:flex;align-items:center;justify-content:space-between;gap:24px;padding:30px 34px;background:#e9ffcf;border-top:1px solid rgba(20,20,20,.08)}
                .gaf-next strong{font-size:18px;letter-spacing:-.02em}
                .gaf-flow{font-size:13px;font-weight:800;letter-spacing:.07em;text-transform:uppercase;color:#49691b}
                @media(max-width:1000px){.gaf-grid{grid-template-columns:repeat(2,1fr)}.gaf-status{position:static;width:max-content;margin-bottom:16px}.gaf-hero{padding:34px}.gaf-hero h1{font-size:54px}}
                @media(max-width:650px){.gaf-wrap{margin-right:10px}.gaf-grid{grid-template-columns:1fr}.gaf-hero h1{font-size:42px}.gaf-next{align-items:flex-start;flex-direction:column}.gaf-tile{min-height:190px}.gaf-tile h2{margin-top:40px}}
            </style>

            <section class="gaf-shell">
                <header class="gaf-hero">
                    <div class="gaf-status"><span class="gaf-dot"></span> 1.0.0 · ACTIVE</div>
                    <div class="gaf-kicker"><span class="gaf-dot"></span> Backend Phase 1 · AVA Lab</div>
                    <h1>GIP APP <em>FACTORY</em></h1>
                    <p>Il primo nucleo operativo della Factory è online. Da qui nasceranno libreria visuale, composizione delle schermate, modifica delle proprietà, salvataggio dei layout e nuovi componenti HTML riutilizzabili.</p>
                </header>

                <div class="gaf-grid">
                    <?php
                    self::tile( '01 · Core', 'Libreria', 'Blocchi e schermate riutilizzabili con anteprima visuale reale.', 'NEXT' );
                    self::tile( '02 · Canvas', 'Builder', 'Composizione visuale e modifica live di contenuto, stile e struttura.', 'PLANNED' );
                    self::tile( '03 · Work', 'Progetti', 'Layout salvati, app separate e versioni senza contaminazioni.', 'PLANNED' );
                    self::tile( '04 · System', 'Factory', 'Preset, varianti, freeze e nuovi componenti generati durante il lavoro.', 'ONLINE' );
                    ?>
                </div>

                <footer class="gaf-next">
                    <strong>Prima vertical slice: libreria reale → inserisci → modifica → salva → reload identico.</strong>
                    <span class="gaf-flow">CREATE → TEST → APPROVE → REUSE</span>
                </footer>
            </section>
        </div>
        <?php
    }
}

register_activation_hook( __FILE__, array( 'GIP_App_Factory_100', 'activate' ) );
GIP_App_Factory_100::boot();
