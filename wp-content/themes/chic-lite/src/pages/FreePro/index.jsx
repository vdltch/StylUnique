
import freevspro from "../../assets/img/freevspro.webp";
import { Sidebar, Icon } from "../../components";
import { __ } from '@wordpress/i18n';
const FreePro = () => {

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
                    <img className="freepro" src={freevspro} alt={__("Free vs Pro image", "chic-lite")} />
                </div>
                <Sidebar sidebarSettings={sidebarSettings} openInNewTab={true}/>
            </div>
        </>
    )
}

export default FreePro;