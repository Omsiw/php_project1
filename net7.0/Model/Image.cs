namespace ApiForPhoto.Model
{
    public class ImageResponce
    {
        public int Id { get; set; }
        public byte[] Data { get; set; }
    }

    public class ImageRequest
    {
        public byte[] Data { get; set; }
        public string GameName { get; set; }
        public string extension { get; set; }
    }
}
