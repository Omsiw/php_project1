using ApiForPhoto.Abstract;
using ApiForPhoto.Model;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace ApiForPhoto.Controllers
{
    [Route("[controller]")]
    [ApiController]
    public class GameIconController : ControllerBase
    {
        private IService service;

        public GameIconController(IService service)
        {
            this.service = service;
            service.SetTable("games");
        }

        [HttpGet("GetGameIcon/{id}")]
        public ActionResult Get([FromRoute]int id)
        {
            return Ok(service.GetImage(id));
        }

        [HttpPost("AddEdtGameIcon")]
        public ActionResult Post([FromBody] ImageResponce image)
        {
            return Ok(service.EditImage(image));
        }

        [HttpGet("DeleteGameDirectory/{name}")]
        public ActionResult Get([FromRoute]string name)
        {
            return Ok(service.DeleteDirectory(name));
        }
    }
}
