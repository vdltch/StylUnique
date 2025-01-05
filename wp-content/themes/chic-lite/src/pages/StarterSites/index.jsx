import { __ } from "@wordpress/i18n";
import { Icon } from "../../components";
import { singleChic, chicFeatured, chicCourses } from "../../components/images"

const StarterSites = () => {
    return (
        <>
            <div className="starter-sites">
                <div className="image-wrapper">
                    <div className="image">
                        <img src={singleChic} alt={__( 'Demo image', 'chic-lite' )} />
                        <div className="reverse-image">
                            <img src={singleChic} alt={__( 'Demo reverse image', 'b' )} />
                        </div>
                    </div>
                    <div className="image">
                        <img src={chicFeatured} alt={__( 'Demo image', 'chic-lite' )} />
                        <div className="reverse-image">
                            <img src={chicFeatured} alt={__( 'Demo reverse image', 'chic-lite' )} />
                        </div>
                    </div>
                    <div className="image">
                        <img src={chicCourses} alt={__( 'Demo image', 'chic-lite' )} />
                        <div className="reverse-image">
                            <img src={chicCourses} alt={__( 'Demo reverse image', 'chic-lite' )} />
                        </div>
                    </div>
                </div>
                <div className="text-wrapper">
                    <h2>{__('One Click Demo Import', 'chic-lite')}</h2>
                    <p dangerouslySetInnerHTML={{ __html: sprintf(__('Get started effortlessly! Use our one-click demo import feature to set up your site instantly with all the sample data and settings. Please note that importing demo content will overwrite your existing site content and settings. %s Not recommended if you have existing content. %s', 'chic-lite'), '<b>', '</b>') }} />
                    <div className="cw-button">
                        <a href={cw_dashboard.get_pro} target="_blank" className="cw-button-btn primary-btn">
                            {__('Get Starter Sites', 'chic-lite')} <Icon icon="arrow" />
                        </a>
                    </div>
                </div>
            </div>
        </>
    );
}

export default StarterSites;