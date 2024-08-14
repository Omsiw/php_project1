using ApiForPhoto.Model;

namespace ApiForPhoto.Abstract
{
    public interface IService
    {
        void SetTable(string table);
        ImageResponce GetImage(int id);
        Result CreateImage(ImageResponce img, string dirName, string extension);
        Result EditImage(ImageResponce img);
        Result DeleteImage(int id);
        Result DeleteDirectory(string dirName);
    }
}
