import { Icon, Sidebar, Card, Heading } from "../../components";
import { __ } from '@wordpress/i18n';

const Homepage = () => {
    const cardLists = [
        {
            iconSvg: <Icon icon="site" />,
            heading: __('Site Identity', 'chic-lite'),
            buttonText: __('Customize', 'chic-lite'),
            buttonUrl: cw_dashboard.custom_logo
        },
        {
            iconSvg: <Icon icon="colorsetting" />,
            heading: __("Color Settings", 'chic-lite'),
            buttonText: __('Customize', 'chic-lite'),
            buttonUrl: cw_dashboard.colors
        },
        {
            iconSvg: <Icon icon="layoutsetting" />,
            heading: __("Layout Settings", 'chic-lite'),
            buttonText: __('Customize', 'chic-lite'),
            buttonUrl: cw_dashboard.layout
        },
        {
            iconSvg: <Icon icon="generalsetting" />,
            heading: __("General Settings"),
            buttonText: __('Customize', 'chic-lite'),
            buttonUrl: cw_dashboard.general
        },
        {
            iconSvg: <Icon icon="footersetting" />,
            heading: __('Footer Settings', 'chic-lite'),
            buttonText: __('Customize', 'chic-lite'),
            buttonUrl: cw_dashboard.footer
        }
    ];

    const proSettings = [
        {
            heading: __('Header Layouts', 'chic-lite'),
            para: __('Choose from different unique header layouts.', 'chic-lite'),
            buttonText: __('Learn More', 'chic-lite'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Layouts', 'chic-lite'),
            para: __('Choose layouts for blogs, banners, posts and more.', 'chic-lite'),
            buttonText: __('Learn More', 'chic-lite'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Sidebar', 'chic-lite'),
            para: __('Set different sidebars for posts and pages.', 'chic-lite'),
            buttonText: "Learn More",
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Boost your website performance with ease.', 'chic-lite'),
            heading: __('Performance Settings', 'chic-lite'),
            buttonText: __('Learn More', 'chic-lite'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Choose typography for different heading tags.', 'chic-lite'),
            heading: __('Typography Settings', 'chic-lite'),
            buttonText: __('Learn More', 'chic-lite'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Import the demo content to kickstart your site.', 'chic-lite'),
            heading: __('One Click Demo Import', 'chic-lite'),
            buttonText: __('Learn More', 'chic-lite'),
            buttonUrl: cw_dashboard?.get_pro
        }
    ];

    const sidebarSettings = [
        {
            heading: __('We Value Your Feedback!', 'chic-lite'),
            icon: "star",
            para: __("Your review helps us improve and assists others in making informed choices. Share your thoughts today!", 'chic-lite'),
            imageurl: <Icon icon="review" />,
            buttonText: __('Leave a Review', 'chic-lite'),
            buttonUrl: cw_dashboard.review
        },
        {
            heading: __('Knowledge Base', 'chic-lite'),
            para: __("Need help using our theme? Visit our well-organized Knowledge Base!", 'chic-lite'),
            imageurl: <Icon icon="documentation" />,
            buttonText: __('Explore', 'chic-lite'),
            buttonUrl: cw_dashboard.docmentation
        },
        {
            heading: __('Need Assistance? ', 'chic-lite'),
            para: __("If you need help or have any questions, don't hesitate to contact our support team. We're here to assist you!", 'chic-lite'),
            imageurl: <Icon icon="supportTwo" />,
            buttonText: __('Submit a Ticket', 'chic-lite'),
            buttonUrl: cw_dashboard.support
        }
    ];

    return (
        <>
            <div className="customizer-settings">
                <div className="cw-customizer">
                    <div className="video-section">
                        <div className="cw-settings">
                            <h2>{__('Chic Lite Tutorial', 'chic-lite')}</h2>
                        </div>
                        <iframe src="https://www.youtube.com/embed/Ym-x7Xv716c?si=r23UUItoygHtL9e6" title={__( 'How to Start a Travel Blog in 2023 | Chic Lite Tutorial','chic-lite' )} frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerPolicy="strict-origin-when-cross-origin" allowFullScreen></iframe>
                    </div>
                    <Heading
                        heading={__( 'Quick Customizer Settings', 'chic-lite' )}
                        buttonText={__( 'Go To Customizer', 'chic-lite' )}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={cardLists}
                        cardPlace='customizer'
                        cardCol='three-col'
                    />
                    <Heading
                        heading={__( 'More features with Pro version', 'chic-lite' )}
                        buttonText={__( 'Go To Customizer', 'chic-lite' )}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={proSettings}
                        cardPlace='cw-pro'
                        cardCol='two-col'
                    />
                    <div className="cw-button">
                        <a href={cw_dashboard?.get_pro} target="_blank" className="cw-button-btn primary-btn long-button">{__('Learn more about the Pro version', 'chic-lite')}</a>
                    </div>
                </div>
                <Sidebar sidebarSettings={sidebarSettings} openInNewTab={true} />
            </div>
        </>
    );
}

export default Homepage;