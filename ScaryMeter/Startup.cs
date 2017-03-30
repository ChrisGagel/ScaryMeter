using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(ScaryMeter.Startup))]
namespace ScaryMeter
{
    public partial class Startup {
        public void Configuration(IAppBuilder app) {
            ConfigureAuth(app);
        }
    }
}
